@extends('superadmin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight" style="color: var(--df-brown)">{{ $tenant->name }}</h2>
            <p style="color: var(--df-muted)">Tenant details</p>
        </div>
        <a href="{{ route('superadmin.tenants.index') }}" class="df-btn df-btn-view">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            Back to list
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Basic information -->
        <section class="df-panel md:col-span-2">
            <div class="df-panel-head">
                <h3 class="df-panel-title">Basic information</h3>
            </div>
            <dl class="divide-y" style="border-color: var(--df-line)">
                @php
                    $rows = [
                        'Business name' => $tenant->name,
                        'Email' => $tenant->admin_email,
                        'Subdomain' => $tenant->subdomain . '.dineflow.com',
                        'Database name' => 'tenant' . $tenant->id,
                        'Created at' => $tenant->created_at->format('M d, Y H:i:s'),
                    ];
                @endphp
                @foreach($rows as $label => $value)
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4" style="border-color: var(--df-line)">
                        <dt class="text-sm font-medium" style="color: var(--df-muted)">{{ $label }}</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 font-semibold">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>

        <!-- Actions -->
        <section class="df-panel self-start">
            <div class="df-panel-head">
                <h3 class="df-panel-title">Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                @if($tenant->status === 'pending')
                    <div class="grid grid-cols-2 gap-3">
                        <form action="{{ route('superadmin.tenants.approve', $tenant) }}" method="POST">
                            @csrf
                            <button type="submit" class="df-btn df-btn-approve w-full justify-center py-2">Approve</button>
                        </form>
                        <form action="{{ route('superadmin.tenants.reject', $tenant) }}" method="POST">
                            @csrf
                            <button type="submit" class="df-btn df-btn-reject w-full justify-center py-2">Reject</button>
                        </form>
                    </div>
                @endif

                @if($tenant->subscription === 'free')
                    <form action="{{ route('superadmin.tenants.upgrade', $tenant) }}" method="POST">
                        @csrf
                        <button type="submit" class="df-btn df-btn-upgrade w-full justify-center py-2">Upgrade to Pro</button>
                    </form>
                @endif

                <a href="http://{{ $tenant->subdomain }}.dineflow.com:8000/welcome" target="_blank"
                   class="df-btn df-btn-primary w-full justify-center py-2">
                    Visit tenant site
                </a>

                <form action="{{ route('superadmin.tenants.destroy', $tenant) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this tenant? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="df-btn df-btn-reject w-full justify-center py-2">Delete tenant</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection