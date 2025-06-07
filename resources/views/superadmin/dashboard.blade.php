@extends('superadmin.layouts.app')

@section('content')
<div class="p-6">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Tenants -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-600">Total Tenants</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $tenants->count() }}</p>
                </div>
                <div class="text-blue-500">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Approved Tenants -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-600">Approved Tenants</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $approvedTenants->count() }}</p>
                </div>
                <div class="text-green-500">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Tenants -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-amber-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-600">Pending Tenants</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingTenants->count() }}</p>
                </div>
                <div class="text-amber-500">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Applications -->
    <div class="bg-white rounded-lg shadow-sm mb-8">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Pending Applications</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subdomain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pendingTenants as $tenant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->subdomain }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $tenant->plan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->admin_email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <form action="{{ route('superadmin.tenants.approve', $tenant) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('superadmin.tenants.reject', $tenant) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No pending applications</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Active Tenants -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Active Tenants</h2>
            <a href="{{ route('superadmin.tenants.create') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Tenant
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subdomain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expires At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($approvedTenants as $tenant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->subdomain }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $tenant->plan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $tenant->expires_at ? $tenant->expires_at->format('Y-m-d') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($tenant->isSubscribed())
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <a href="{{ route('superadmin.tenants.show', $tenant) }}" 
                               class="text-blue-600 hover:text-blue-900">View</a>
                            <form action="{{ route('superadmin.tenants.destroy', $tenant) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900 ml-2"
                                        onclick="return confirm('Are you sure you want to delete this tenant?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No active tenants found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
