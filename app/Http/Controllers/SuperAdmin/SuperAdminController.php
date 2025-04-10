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
        return view('superadmin.dashboard', compact('tenants'));
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
            'password' => 'required|min:8',
        ]);

        try {
            DB::beginTransaction();

            // Create tenant record
            $tenant = Tenant::create([
                'name' => $request->name,
                'email' => $request->email,
                'subdomain' => $request->subdomain,
                'database_name' => 'tenant_' . Str::slug($request->subdomain),
            ]);

            // Create tenant database
            $database = 'tenant_' . Str::slug($request->subdomain);
            DB::statement("CREATE DATABASE {$database}");

            // Run migrations for new tenant database
            Artisan::call('migrate', [
                '--database' => $database,
                '--path' => 'database/migrations/tenant',
                '--force' => true
            ]);

            DB::commit();

            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating tenant: ' . $e->getMessage());
        }
    }

    public function show(Tenant $tenant)
    {
        return view('superadmin.tenants.show', compact('tenant'));
    }

    public function destroy(Tenant $tenant)
    {
        try {
            DB::statement("DROP DATABASE {$tenant->database_name}");
            $tenant->delete();
            return redirect()->route('superadmin.tenants.index')
                ->with('success', 'Tenant deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting tenant: ' . $e->getMessage());
        }
    }
}
