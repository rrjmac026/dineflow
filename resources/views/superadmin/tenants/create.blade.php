@extends('superadmin.layouts.app')

@section('content')
<style>
    .df-label { display: block; font-size: .875rem; font-weight: 600; color: var(--df-brown); }
    .df-input { margin-top: .25rem; display: block; width: 100%; border: 1px solid var(--df-line); border-radius: .6rem;
                background: #fff; color: var(--df-ink); padding: .55rem .75rem; }
    .df-input:focus { outline: none; border-color: var(--df-amber); box-shadow: 0 0 0 3px rgba(217,130,43,.25); }
    .df-error { margin-top: .25rem; font-size: .875rem; color: var(--df-red); }
    .df-addon { display: inline-flex; align-items: center; padding: 0 .85rem; border: 1px solid var(--df-line); border-left: 0;
                border-radius: 0 .6rem .6rem 0; background: var(--df-cream); color: var(--df-muted); }
</style>

<div class="max-w-4xl mx-auto">
    <section class="df-panel">
        <div class="df-panel-head">
            <h2 class="df-panel-title">Create new tenant</h2>
            <a href="{{ route('superadmin.tenants.index') }}" class="df-btn df-btn-view">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to list
            </a>
        </div>

        <form action="{{ route('superadmin.tenants.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Business info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="df-label">Business name</label>
                    <input type="text" name="name" id="name" required class="df-input" value="{{ old('name') }}">
                    @error('name') <p class="df-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="admin_email" class="df-label">Admin email</label>
                    <input type="email" name="admin_email" id="admin_email" required class="df-input" value="{{ old('admin_email') }}">
                    @error('admin_email') <p class="df-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Subdomain and plan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="subdomain" class="df-label">Subdomain</label>
                    <div class="flex">
                        <input type="text" name="subdomain" id="subdomain" required class="df-input"
                               style="border-radius: .6rem 0 0 .6rem" value="{{ old('subdomain') }}">
                        <span class="df-addon" style="margin-top: .25rem">.dineflow.com</span>
                    </div>
                    @error('subdomain') <p class="df-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subscription" class="df-label">Subscription plan</label>
                    <select name="subscription" id="subscription" required class="df-input"
                            onchange="toggleProOptions(this.value)">
                        <option value="free" {{ old('subscription') == 'free' ? 'selected' : '' }}>Free plan</option>
                        <option value="pro" {{ old('subscription') == 'pro' ? 'selected' : '' }}>Pro plan</option>
                    </select>
                    @error('subscription') <p class="df-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Pro plan options -->
            <div id="proOptions" class="{{ old('subscription') == 'pro' ? '' : 'hidden' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 rounded-xl" style="background: var(--df-cream); border: 1px solid var(--df-line)">
                    <div>
                        <label for="primary_color" class="df-label">Primary color</label>
                        <input type="color" name="primary_color" id="primary_color" class="df-input"
                               style="height: 2.6rem; padding: .25rem" value="{{ old('primary_color', '#D9822B') }}">
                        @error('primary_color') <p class="df-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="logo_path" class="df-label">Logo path</label>
                        <input type="text" name="logo_path" id="logo_path" class="df-input"
                               value="{{ old('logo_path') }}" placeholder="/path/to/logo.png">
                        @error('logo_path') <p class="df-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('superadmin.tenants.index') }}" class="df-btn df-btn-view py-2 px-4">Cancel</a>
                <button type="submit" class="df-btn df-btn-primary py-2 px-4">Create tenant</button>
            </div>
        </form>
    </section>
</div>

<script>
function toggleProOptions(plan) {
    document.getElementById('proOptions').classList.toggle('hidden', plan !== 'pro');
}
</script>
@endsection