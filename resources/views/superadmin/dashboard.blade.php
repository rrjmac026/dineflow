@extends('superadmin.layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Welcome banner (same photo + dark overlay as the welcome page) -->
    <section class="relative rounded-2xl overflow-hidden px-6 py-8 sm:px-10 sm:py-10"
             style="background-image: linear-gradient(90deg, rgba(56,25,10,.92), rgba(74,35,13,.55)), url('/background.jpg'); background-size: cover; background-position: center;">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
            Welcome back, {{ auth()->user()->name }}
        </h1>
        <p class="mt-2 text-white/85 text-lg max-w-xl">
            @if($pendingTenants->count() > 0)
                {{ $pendingTenants->count() }} {{ Str::plural('restaurant', $pendingTenants->count()) }} waiting for your approval.
            @else
                No applications waiting. Everything is up to date.
            @endif
        </p>
        <a href="{{ route('superadmin.tenants.create') }}" class="df-btn df-btn-primary mt-5">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add tenant
        </a>
    </section>

    <!-- Stats: one joined panel instead of three separate cards -->
    <section class="df-panel grid grid-cols-1 md:grid-cols-3 md:divide-x divide-y md:divide-y-0" style="--tw-divide-opacity: 1; border-color: var(--df-line);">
        <div class="p-6 flex items-center gap-4">
            <span class="h-12 w-12 rounded-xl flex items-center justify-center text-white" style="background: var(--df-brown)">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </span>
            <div>
                <p class="text-3xl font-extrabold" style="color: var(--df-brown)">{{ $tenants->count() }}</p>
                <p class="text-sm font-medium" style="color: var(--df-muted)">Total tenants</p>
            </div>
        </div>

        <div class="p-6 flex items-center gap-4">
            <span class="h-12 w-12 rounded-xl flex items-center justify-center text-white" style="background: var(--df-sage)">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            <div>
                <p class="text-3xl font-extrabold" style="color: var(--df-brown)">{{ $approvedTenants->count() }}</p>
                <p class="text-sm font-medium" style="color: var(--df-muted)">Approved</p>
            </div>
        </div>

        <div class="p-6 flex items-center gap-4">
            <span class="h-12 w-12 rounded-xl flex items-center justify-center text-white" style="background: var(--df-amber)">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            <div>
                <p class="text-3xl font-extrabold" style="color: var(--df-brown)">{{ $pendingTenants->count() }}</p>
                <p class="text-sm font-medium" style="color: var(--df-muted)">Pending review</p>
            </div>
        </div>
    </section>

    <!-- Pending applications -->
    <section class="df-panel">
        <div class="df-panel-head">
            <h2 class="df-panel-title">Pending applications</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="df-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subdomain</th>
                        <th>Subscription</th>
                        <th>Admin email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingTenants as $tenant)
                    <tr>
                        <td class="font-semibold">{{ $tenant->name }}</td>
                        <td>{{ $tenant->subdomain }}</td>
                        <td class="capitalize">{{ $tenant->subscription }}</td>
                        <td>{{ $tenant->admin_email }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('superadmin.tenants.approve', $tenant) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="df-btn df-btn-approve">Approve</button>
                                </form>
                                <form action="{{ route('superadmin.tenants.reject', $tenant) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="df-btn df-btn-reject">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="df-empty">No pending applications</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Active tenants -->
    <section class="df-panel">
        <div class="df-panel-head">
            <h2 class="df-panel-title">Active tenants</h2>
            <a href="{{ route('superadmin.tenants.create') }}" class="df-btn df-btn-primary">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add new tenant
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="df-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subdomain</th>
                        <th>Subscription</th>
                        <th>Expires at</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvedTenants as $tenant)
                    <tr>
                        <td class="font-semibold">{{ $tenant->name }}</td>
                        <td>{{ $tenant->subdomain }}</td>
                        <td class="capitalize">{{ $tenant->subscription }}</td>
                        <td>{{ $tenant->expires_at ? $tenant->expires_at->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            @if($tenant->isSubscribed())
                                <span class="df-pill df-pill-active">Active</span>
                            @else
                                <span class="df-pill df-pill-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('superadmin.tenants.show', $tenant) }}" class="df-btn df-btn-view">View</a>

                                @if($tenant->subscription === 'free')
                                    <form action="{{ route('superadmin.tenants.upgrade', $tenant) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="df-btn df-btn-upgrade">Upgrade to Pro</button>
                                    </form>
                                @endif

                                <form action="{{ route('superadmin.tenants.destroy', $tenant) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="df-btn df-btn-delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="df-empty">No active tenants found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection