<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CustomerManagementController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->latest()
            ->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully!');
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully!');
    }
}
