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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            .bg-image {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/background.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                min-height: 100vh;
                width: 100vw;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: -1;
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            }
            .welcome-text {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
        </style>
    </head>
    <body class="antialiased min-h-screen overflow-x-hidden">
        <div class="bg-image"></div>
        
        <div class="relative min-h-screen flex flex-col items-center justify-center px-4">
            <!-- Navigation -->
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 p-6 glass-effect rounded-bl-2xl z-50">
                    <nav class="space-x-4">
                        @auth
                            <a href="{{ url('superadmin.dashboard') }}" class="font-semibold text-white hover:text-amber-300 transition-colors duration-200">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('superadmin.login') }}" class="font-semibold text-white hover:text-amber-300 transition-colors duration-200">
                                <i class="fas fa-sign-in-alt mr-2"></i>Log in
                            </a>
                        @if (Route::has('register'))
                                <a href="{{ route('superadmin.register') }}" class="font-semibold text-white hover:text-amber-300 transition-colors duration-200">
                                    <i class="fas fa-user-plus mr-2"></i>Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif

            <!-- Main Content -->
            <div class="glass-effect p-8 sm:p-12 rounded-2xl w-full max-w-2xl mx-auto text-center transform transition-all duration-500 hover:scale-105">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 welcome-text tracking-tight">
                    Welcome to DineFlow
                </h1>
                <p class="text-lg sm:text-xl text-white/90 mb-8 leading-relaxed">
                    Experience the perfect blend of taste and technology
                </p>
                
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <a href="{{ route('login') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-105">
                            <i class="fas fa-utensils mr-2"></i>
                            Start Ordering
                        </a>
                        <a href="{{ route('register') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-105">
                            <i class="fas fa-user-plus mr-2"></i>
                            Join Now
                        </a>
                    </div>
                
            </div>

            <!-- Footer -->
            <div class="absolute bottom-0 w-full p-4 text-center text-white/80 glass-effect">
                <p class="text-sm">&copy; {{ date('Y') }} DineFlow. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>