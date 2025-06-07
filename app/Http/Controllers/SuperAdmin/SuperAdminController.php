<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;


class SuperAdminController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        $approvedTenants = Tenant::where('status', 'approved')->get();
        $pendingTenants = Tenant::where('status', 'pending')->get();

        return view('superadmin.tenants.index', compact('tenants', 'approvedTenants', 'pendingTenants'));
    }

    public function dashboard()
    {
        $tenants = Tenant::all();
        $approvedTenants = Tenant::where('status', 'approved')->get();
        $pendingTenants = Tenant::where('status', 'pending')->get();

        return view('superadmin.dashboard', compact('tenants', 'approvedTenants', 'pendingTenants'));
    }


    public function create()
    {
        return view('superadmin.tenants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:tenants,admin_email',
            'subdomain' => 'required|string|unique:tenants,subdomain',
            'plan' => 'required|in:free,pro',
        ]);

        try {
            $tenant = Tenant::create([
                'name' => $request->name,
                'admin_email' => $request->admin_email,
                'subdomain' => strtolower($request->subdomain),
                'plan' => $request->plan,
                'status' => 'pending',  // Use enum string instead of boolean
                'expires_at' => null,
            ]);

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant registration submitted for approval');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating tenant: ' . $e->getMessage());
        }
    }

    public function approve(Tenant $tenant)
    {
        DB::beginTransaction();

        try {
            // Create domain with correct format using tenant's subdomain
            $tenant->domains()->create([
                'domain' => $tenant->subdomain . '.dineflow.com'
            ]);
            
            // Update status using enum string
            $tenant->status = 'approved';
            $tenant->expires_at = now()->addDays(30);
            $tenant->save();

            // Run migrations
            $tenant->run(function () {
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/tenant',
                    '--force' => true
                ]);
            });

            DB::commit();
            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant approved and database created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error approving tenant: ' . $e->getMessage());
        }
    }

    public function reject(Tenant $tenant)
    {
        try {
            $tenant->status = 'rejected';  // Use enum string instead of boolean
            $tenant->save();

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant registration rejected');
        } catch (\Exception $e) {
            return back()->with('error', 'Error rejecting tenant: ' . $e->getMessage());
        }
    }

    public function show(Tenant $tenant)
    {
        return view('superadmin.tenants.show', compact('tenant'));
    }

    public function destroy(Tenant $tenant)
    {
        try {
            $tenant->delete();

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting tenant: ' . $e->getMessage());
        }
    }
}
