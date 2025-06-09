<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Login - DineFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs" defer></script> <!-- ✅ ADD THIS -->

    <style>
        .bg-image {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/background.jpg');
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
    </style>
</head>

<body class="antialiased min-h-screen overflow-x-hidden">
    <div class="bg-image"></div>
        @if (session('status'))
            <div 
                x-data="{ show: true }" 
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                x-init="setTimeout(() => show = false, 4000)"
                class="fixed top-5 right-5 z-50 w-full max-w-sm mx-auto bg-green-600 text-white rounded-lg shadow-lg overflow-hidden"
            >
                <div class="flex items-start px-4 py-3">
                    <!-- Icon -->
                    <div class="flex-shrink-0 mt-0.5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Message -->
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium leading-5">
                            {{ session('status') }}
                        </p>
                    </div>

                    <!-- Close button -->
                    <button @click="show = false" class="ml-3 text-white hover:text-gray-100 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif


    
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="glass-effect w-full max-w-md p-6 sm:p-8 rounded-xl">
            <!-- Logo and Welcome Section -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-yellow-500 to-red-500 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 shadow-lg">
                    <i class="fas fa-user-shield text-2xl sm:text-3xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Super Admin Login</h2>
                <p class="mt-2 text-sm text-white/80">Access restricted area</p>
            </div>

            <form method="POST" action="{{ route('superadmin.login') }}" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="email">Email</label>
                    <input class="w-full px-3 py-2 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                           id="email" 
                           type="email" 
                           name="email" 
                           placeholder="Enter your email"
                           required 
                           autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="password">Password</label>
                    <input class="w-full px-3 py-2 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                           id="password" 
                           type="password" 
                           name="password" 
                           placeholder="Enter your password"
                           required>
                </div>

                @if ($errors->any())
                    <div class="text-red-400 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full px-4 py-3 bg-gradient-to-r from-yellow-500 to-red-500 hover:from-yellow-600 hover:to-red-600 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:scale-[.99] focus:ring-2 focus:ring-yellow-500">
                    Sign in
                </button>
            </form>
        </div>
    </div>
</body>
</html>
