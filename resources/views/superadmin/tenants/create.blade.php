@extends('superadmin.layouts.app')

@section('content')
<div class="min-h-screen py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Create New Tenant</h2>
                    <a href="{{ route('superadmin.tenants.index') }}" 
                       class="flex items-center text-gray-600 hover:text-gray-900">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Back to list
                    </a>
                </div>

                <form action="{{ route('superadmin.tenants.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Business Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Business Name</label>
                            <input type="text" name="name" id="name" required
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="admin_email" class="block text-sm font-medium text-gray-700">Admin Email</label>
                            <input type="email" name="admin_email" id="admin_email" required
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('admin_email') }}">
                            @error('admin_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subdomain and Plan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="subdomain" class="block text-sm font-medium text-gray-700">Subdomain</label>
                            <div class="mt-1 flex rounded-lg shadow-sm">
                                <input type="text" name="subdomain" id="subdomain" required
                                       class="flex-1 rounded-l-lg border-gray-300 focus:ring-2 focus:ring-blue-500"
                                       value="{{ old('subdomain') }}">
                                <span class="inline-flex items-center px-3 rounded-r-lg border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                                    .dineflow.com
                                </span>
                            </div>
                            @error('subdomain')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subscription" class="block text-sm font-medium text-gray-700">Subscription Plan</label>
                            <select name="subscription" id="subscription" required
        ...
                                onchange="toggleProOptions(this.value)">
                            <option value="free" {{ old('subscription') == 'free' ? 'selected' : '' }}>Free Plan</option>
                            <option value="pro" {{ old('subscription') == 'pro' ? 'selected' : '' }}>Pro Plan</option>
                        </select>
                        @error('subscription')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pro Plan Options -->
                    <div id="proOptions" class="space-y-6 {{ old('plan') == 'pro' ? '' : 'hidden' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="primary_color" class="block text-sm font-medium text-gray-700">Primary Color</label>
                                <input type="color" name="primary_color" id="primary_color"
                                       class="mt-1 block w-full h-10 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500"
                                       value="{{ old('primary_color', '#4F46E5') }}">
                                @error('primary_color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="logo_path" class="block text-sm font-medium text-gray-700">Logo Path</label>
                                <input type="text" name="logo_path" id="logo_path"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500"
                                       value="{{ old('logo_path') }}"
                                       placeholder="/path/to/logo.png">
                                @error('logo_path')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('superadmin.tenants.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Tenant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleProOptions(plan) {
    const proOptions = document.getElementById('proOptions');
    proOptions.classList.toggle('hidden', plan !== 'pro');
}
</script>
@endsection
