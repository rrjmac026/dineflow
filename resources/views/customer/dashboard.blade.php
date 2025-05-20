@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2">My Orders</h2>
                    <a href="{{ route('customer.orders') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">View Orders</a>
                </div>
                <div class="p-4 bg-green-50 dark:bg-green-900 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2">Menu</h2>
                    <a href="{{ route('customer.menu') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Browse Menu</a>
                </div>
                <div class="p-4 bg-purple-50 dark:bg-purple-900 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2">Reservations</h2>
                    <a href="{{ route('customer.reservations') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Manage Reservations</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
