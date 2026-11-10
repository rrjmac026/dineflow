<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\TenantApprovalMail;
use App\Mail\TenantRejectionMail;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\HostsFileService;
use Illuminate\Support\Facades\Log;

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
            'subscription' => 'required|in:free,pro',
        ]);

        try {
            $tenant = Tenant::create([
                'id'           => $this->generateTenantId($request->name),
                'name'         => $request->name,
                'admin_email'  => $request->admin_email,
                'subdomain'    => strtolower($request->subdomain),
                'subscription' => $request->subscription,
                'status'       => 'pending',
                'expires_at'   => null,
            ]);

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant registration submitted for approval');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating tenant: ' . $e->getMessage());
        }
    }

    public function upgrade(Tenant $tenant)
    {
        try {
            $tenant->subscription = 'pro';
            $tenant->expires_at = now()->addYear(); // or whatever your logic is
            $tenant->save();

            return redirect()->back()->with('success', 'Tenant upgraded to Pro successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error upgrading tenant: ' . $e->getMessage());
        }
    }


    public function approve(Tenant $tenant)
    {
        DB::beginTransaction();

        try {
            // Generate admin password with DINEFLOW prefix and 6 random digits
            $password = 'DINEFLOW' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Create domain
            $tenant->domains()->create([
                'domain' => $tenant->subdomain . '.dineflow.com'
            ]);

            $tenant->status = 'approved';
            $tenant->expires_at = now()->addDays(30);
            $tenant->save();

            // Run migrations and create admin user
            $tenant->run(function () use ($tenant, $password) {
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/tenant',
                    '--force' => true
                ]);

                // Create admin user in tenant database
                DB::connection('tenant')->table('users')->insert([
                    'name' => $tenant->name,
                    'email' => $tenant->admin_email,
                    'password' => Hash::make($password),
                    'role' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });

            Mail::to($tenant->admin_email)->send(new TenantApprovalMail($tenant, $password));

            DB::commit();

            // Write the subdomain to the hosts file (never blocks approval)
            try {
                (new HostsFileService())->addTenantEntry($tenant->subdomain, $tenant->name);
            } catch (\Throwable $e) {
                Log::warning("Tenant approved but hosts file could not be updated: " . $e->getMessage());
            }

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant approved and credentials sent');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error approving tenant: ' . $e->getMessage());
        }
    }

    public function reject(Tenant $tenant)
    {
        try {
            $tenant->status = 'rejected';
            $tenant->save();

            // Send rejection email
            Mail::to($tenant->admin_email)->send(new TenantRejectionMail($tenant));

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
            $subdomain = $tenant->subdomain; // capture before deletion

            $tenant->delete();

            try {
                (new HostsFileService())->removeTenantEntry($subdomain);
            } catch (\Throwable $e) {
                Log::warning("Tenant deleted but hosts file entry could not be removed: " . $e->getMessage());
            }

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting tenant: ' . $e->getMessage());
        }
    }

    private function generateTenantId(string $name): string
    {
        $base = preg_replace('/[^a-z0-9]+/', '_', strtolower($name));
        $base = trim($base, '_');

        if (!preg_match('/^[a-z]/', $base)) {
            $base = 'tenant_' . $base;
        }

        $base = substr($base, 0, 50); // MySQL DB name limit is 64 incl. prefix

        $candidate = $base;
        $counter   = 2;

        while (Tenant::where('id', $candidate)->exists()) {
            $candidate = $base . '_' . $counter;
            $counter++;
        }

        return $candidate;
    }
}
