<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :class="{ 'dark': $store.darkMode.on }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DineFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('darkMode', {
                    on: localStorage.getItem('darkMode') === 'true',
                    toggle() {
                        this.on = !this.on;
                        localStorage.setItem('darkMode', this.on);
                    }
                })

                Alpine.store('sidebar', {
                    isOpen: window.innerWidth >= 1024,
                    toggle() { this.isOpen = !this.isOpen }
                })
            })
        </script>

        <style>
            [x-cloak] { display: none !important; }

            :root {
                --df-brown: #4A230D;
                --df-brown-deep: #38190A;
                --df-cream: #F5F0EE;
                --df-paper: #FFFCFA;
                --df-line: #E6D9D1;
                --df-ink: #2B1608;
                --df-muted: #8A6F5E;
                --df-amber: #D9822B;
                --df-sage: #6F9A6B;
                --df-red: #A8402F;
            }

            body { font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif; background: var(--df-cream); color: var(--df-ink); }
            html.dark body { background: #2A1407; color: var(--df-cream); }

            /* Page heading bar */
            .df-header { background: var(--df-paper); border-bottom: 1px solid var(--df-line); }
            .df-header :where(h1, h2) { color: var(--df-brown); font-weight: 800; font-size: 1.5rem; letter-spacing: -.01em; }
            html.dark .df-header { background: var(--df-brown-deep); border-color: rgba(255,255,255,.08); }
            html.dark .df-header :where(h1, h2) { color: var(--df-cream); }

            /* Reusable page pieces */
            .df-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1.25rem; }
            .df-card { background: var(--df-paper); border: 1px solid var(--df-line); border-radius: 1rem; padding: 1.25rem 1.5rem; }
            html.dark .df-card { background: var(--df-brown-deep); border-color: rgba(255,255,255,.08); color: var(--df-cream); }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Page Wrapper -->
            <div class="flex pt-16"> <!-- pt-16 offsets the fixed navbar -->
                <!-- Sidebar -->
                @include('layouts.sidebar')

                <!-- Main Content -->
                <div class="flex-1 min-w-0 transition-all duration-300"
                     :class="{'lg:pl-72': $store.sidebar.isOpen}">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="df-header">
                            <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content (padding keeps content off the sidebar edge) -->
                    <main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
                        @hasSection('content')
                            @yield('content')
                        @else
                            {{ $slot ?? '' }}
                        @endif
                    </main>
                </div>
            </div>
        </div>
        <x-alert-script />
    </body>
</html>