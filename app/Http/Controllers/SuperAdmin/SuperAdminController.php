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
        $pendingTenants = Tenant::where('status', 'pending')->get();
        $approvedTenants = Tenant::where('status', 'approved')->get();
        $tenants = Tenant::all(); // Keep this for backward compatibility
        return view('superadmin.dashboard', compact('pendingTenants', 'approvedTenants', 'tenants'));
    }

    public function create()
    {
        return view('superadmin.tenants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants',
            'subdomain' => 'required|string|unique:tenants',
        ]);

        try {
            // Generate a unique tenant ID
            $tenantId = strtolower(Str::random(8));

            // Create tenant record with pending status
            $tenant = new Tenant([
                'id' => $tenantId,
                'name' => $request->name,
                'email' => $request->email,
                'subdomain' => $request->subdomain,
                'status' => 'pending',
                'data' => json_encode([
                    'created_at' => now(),
                ])
            ]);
            $tenant->save();

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
            // Create domain for tenant
            $tenant->domains()->create([
                'domain' => $tenant->subdomain . '.dineflow.test'
            ]);

            // Update tenant status
            $tenant->status = 'approved';
            $tenant->save();

            // Run migrations within tenant context
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
        $tenant->status = 'rejected';
        $tenant->save();

        return redirect()->route('superadmin.tenants.index')
            ->with('success', 'Tenant registration rejected');
    }

    public function show(Tenant $tenant)
    {
        return view('superadmin.tenants.show', compact('tenant'));
    }

    public function destroy(Tenant $tenant)
    {
        try {
            // Let the package handle deletion
            $tenant->delete();
            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting tenant: ' . $e->getMessage());
        }
    }
}
