@extends('superadmin.layouts.app')

@section('content')
<style>
    .df-pill-pending { background: #F8E7D2; color: var(--df-amber-dark); }
</style>

<section class="df-panel">
    <div class="df-panel-head">
        <h2 class="df-panel-title">Manage tenants</h2>
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
                    <th>Email</th>
                    <th>Subdomain</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenants as $tenant)
                <tr>
                    <td class="font-semibold">{{ $tenant->name }}</td>
                    <td>{{ $tenant->admin_email }}</td>
                    <td>{{ $tenant->subdomain }}</td>
                    <td>
                        @if($tenant->status === 'approved')
                            <span class="df-pill df-pill-active">Approved</span>
                        @elseif($tenant->status === 'rejected')
                            <span class="df-pill df-pill-inactive">Rejected</span>
                        @else
                            <span class="df-pill df-pill-pending">Pending</span>
                        @endif
                    </td>
                    <td>{{ $tenant->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('superadmin.tenants.show', $tenant) }}" class="df-btn df-btn-view">View</a>
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
                    <td colspan="6" class="df-empty">No tenants yet. Add your first restaurant to get started.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection