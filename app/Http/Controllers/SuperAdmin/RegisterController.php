<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('superadmin.auth.register');
    }

    public function registerTenant(Request $request)
    {
        $request->validate([
            'tenant_name' => 'required|string|max:255',
            'subdomain' => 'required|string|unique:tenants,subdomain',
            'plan' => 'required|in:free,pro',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        $tenant = Tenant::create([
            'id' => Str::uuid()->toString(),
            'name' => $request->tenant_name,
            'subdomain' => $request->subdomain,
            'plan' => $request->plan,
            'status' => 'pending',
            'expiration_date' => null,

        ]);

        $adminUser = User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'admin',
            'tenant_id' => $tenant->id,
        ]);

        // Optionally send notification email here

        return redirect()->route('superadmin.tenants.index')->with('status', 'Tenant registration submitted and awaiting approval.');
    }
}
