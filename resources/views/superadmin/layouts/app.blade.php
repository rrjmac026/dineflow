<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - SuperAdmin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --df-brown: #4A230D;
            --df-brown-deep: #38190A;
            --df-cream: #F5F0EE;
            --df-paper: #FFFCFA;
            --df-line: #E6D9D1;
            --df-ink: #2B1608;
            --df-muted: #8A6F5E;
            --df-amber: #D9822B;
            --df-amber-dark: #B96A1C;
            --df-sage: #6F9A6B;
            --df-sage-dark: #587D55;
            --df-red: #A8402F;
        }
        [x-cloak] { display: none !important; }

        body { font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif; background: var(--df-cream); color: var(--df-ink); }

        /* Navigation */
        .df-nav { background: var(--df-brown); box-shadow: 0 2px 0 var(--df-brown-deep); }
        .df-nav-link { display: inline-flex; align-items: center; height: 100%; padding: 0 1rem; color: rgba(245,240,238,.7);
                       border-bottom: 3px solid transparent; font-weight: 500; transition: color .15s, border-color .15s; }
        .df-nav-link:hover { color: #fff; border-color: rgba(217,130,43,.5); }
        .df-nav-link.is-active { color: #fff; border-color: var(--df-amber); }
        .df-nav a:focus-visible, .df-nav button:focus-visible { outline: 2px solid var(--df-amber); outline-offset: 2px; border-radius: 4px; }

        /* Surfaces */
        .df-panel { background: var(--df-paper); border: 1px solid var(--df-line); border-radius: 1rem; overflow: hidden; }
        .df-panel-head { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--df-line); display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .df-panel-title { font-size: 1.125rem; font-weight: 700; color: var(--df-brown); }

        /* Tables */
        .df-table { min-width: 100%; border-collapse: collapse; }
        .df-table th { padding: .75rem 1.5rem; text-align: left; font-size: .8rem; font-weight: 600; color: var(--df-muted); background: var(--df-cream); }
        .df-table td { padding: 1rem 1.5rem; white-space: nowrap; border-top: 1px solid var(--df-line); }
        .df-table tbody tr:hover { background: #FBF6F3; }
        .df-empty { padding: 2rem 1.5rem; text-align: center; color: var(--df-muted); }

        /* Buttons */
        .df-btn { display: inline-flex; align-items: center; gap: .4rem; padding: .4rem .85rem; border-radius: .5rem; font-size: .875rem; font-weight: 600;
                  border: 1px solid transparent; transition: background .15s, color .15s, border-color .15s; cursor: pointer; }
        .df-btn:focus-visible { outline: 2px solid var(--df-amber); outline-offset: 2px; }
        .df-btn-primary { background: var(--df-amber); color: #fff; }
        .df-btn-primary:hover { background: var(--df-amber-dark); }
        .df-btn-approve { background: var(--df-sage); color: #fff; }
        .df-btn-approve:hover { background: var(--df-sage-dark); }
        .df-btn-reject { background: transparent; color: var(--df-red); border-color: var(--df-red); }
        .df-btn-reject:hover { background: var(--df-red); color: #fff; }
        .df-btn-view { background: var(--df-cream); color: var(--df-brown); border-color: var(--df-line); }
        .df-btn-view:hover { background: var(--df-brown); color: #fff; border-color: var(--df-brown); }
        .df-btn-upgrade { background: #F8E7D2; color: var(--df-amber-dark); }
        .df-btn-upgrade:hover { background: #F1D5B2; }
        .df-btn-delete { background: #F6E2DD; color: var(--df-red); }
        .df-btn-delete:hover { background: #EBC6BD; }

        /* Status pills */
        .df-pill { display: inline-flex; align-items: center; gap: .35rem; padding: .15rem .65rem; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .df-pill::before { content: ""; width: .45rem; height: .45rem; border-radius: 50%; background: currentColor; }
        .df-pill-active { background: #E3EEE1; color: var(--df-sage-dark); }
        .df-pill-inactive { background: #F6E2DD; color: var(--df-red); }

        /* Flash messages */
        .df-flash { padding: .85rem 1.1rem; border-radius: .75rem; margin-bottom: 1rem; border-left: 4px solid; font-weight: 500; }
        .df-flash-success { background: #E3EEE1; border-color: var(--df-sage); color: #3E5E3B; }
        .df-flash-error { background: #F6E2DD; border-color: var(--df-red); color: #7A2D20; }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="df-nav">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center space-x-3">
                                <svg class="h-8 w-8" style="color: var(--df-amber)" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                                </svg>
                                <span class="text-xl font-extrabold tracking-tight text-white">DineFlow Central</span>
                            </a>
                        </div>

                        <div class="hidden sm:ml-8 sm:flex">
                            <a href="{{ route('superadmin.dashboard') }}"
                               class="df-nav-link {{ request()->routeIs('superadmin.dashboard') ? 'is-active' : '' }}">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('superadmin.tenants.index') }}"
                               class="df-nav-link {{ request()->routeIs('superadmin.tenants.*') ? 'is-active' : '' }}">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Tenants
                            </a>
                        </div>
                    </div>

                    <!-- User dropdown -->
                    <div class="flex items-center">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-white/90 hover:text-white">
                                <img class="h-8 w-8 rounded-full object-cover ring-2" style="--tw-ring-color: var(--df-amber)"
                                     src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=4A230D&background=F5F0EE&bold=true"
                                     alt="Profile">
                                <span class="hidden sm:block font-medium">{{ auth()->user()->name }}</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-cloak x-show="open" @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 py-2 rounded-xl shadow-xl z-50"
                                 style="background: var(--df-paper); border: 1px solid var(--df-line)">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-[#F5F0EE]" style="color: var(--df-ink)">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-[#F5F0EE]" style="color: var(--df-ink)">Settings</a>
                                <div style="border-top: 1px solid var(--df-line)" class="my-1"></div>
                                <form method="POST" action="{{ route('superadmin.logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-[#F6E2DD]" style="color: var(--df-red)">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile links -->
            <div class="sm:hidden flex border-t border-white/10">
                <a href="{{ route('superadmin.dashboard') }}" class="df-nav-link flex-1 justify-center py-3 {{ request()->routeIs('superadmin.dashboard') ? 'is-active' : '' }}">Dashboard</a>
                <a href="{{ route('superadmin.tenants.index') }}" class="df-nav-link flex-1 justify-center py-3 {{ request()->routeIs('superadmin.tenants.*') ? 'is-active' : '' }}">Tenants</a>
            </div>
        </nav>

        <!-- Main content -->
        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="df-flash df-flash-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="df-flash df-flash-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>