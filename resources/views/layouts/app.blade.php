<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark', sidebarOpen: localStorage.getItem('sidebar') === 'true' }"
      x-init="
        $watch('sidebarOpen', value => localStorage.setItem('sidebar', value));
        if (darkMode) { 
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
      "
      :class="{'dark': darkMode}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DineFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen">
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <main id="mainContent" class="transition-all duration-300"
                  :class="{'lg:pl-64': $store.sidebar.isOpen, 'lg:pl-0': !$store.sidebar.isOpen}">
                
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <div class="py-8 space-y-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
