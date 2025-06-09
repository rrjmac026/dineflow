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
            'subscription' => 'required|in:free,pro', // match your form field name
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:tenants,admin_email',
        ]);

        try {
            // Only create the Tenant record, don't create User or run migrations yet
            Tenant::create([
                'id' => Str::uuid()->toString(),
                'name' => $request->tenant_name,
                'subdomain' => strtolower($request->subdomain),
                'admin_email' => $request->admin_email,
                'subscription' => $request->subscription, // match form field
                'status' => 'pending',
                'expires_at' => null,
            ]);

            return redirect()->route('superadmin.login')->with('status', 'Registration submitted. Please wait for approval.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error during registration: ' . $e->getMessage());
        }
    }

}
