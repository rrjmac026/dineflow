@extends('superadmin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Tenant Details</h2>
            <a href="{{ route('superadmin.tenants.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Business Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $tenant->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $tenant->admin_email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Subdomain</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $tenant->subdomain }}.dineflow.com</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Database Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">tenant{{ $tenant->id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created At</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $tenant->created_at->format('M d, Y H:i:s') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Actions</h3>
                <div class="bg-gray-50 p-6 rounded-lg space-y-4">
                    {{-- Upgrade Button --}}
                    @if($tenant->subscription === 'free')
                        <form action="{{ route('superadmin.tenants.upgrade', $tenant) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                                Upgrade to Pro
                            </button>
                        </form>
                    @endif

                    {{-- Visit Site --}}
                    <a href="http://{{ $tenant->subdomain }}.dineflow.com:8000/welcome" 
                    target="_blank"
                    class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Visit Tenant Site
                    </a>

                    {{-- Delete Tenant --}}
                    <form action="{{ route('superadmin.tenants.destroy', $tenant) }}" 
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this tenant? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Delete Tenant
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
