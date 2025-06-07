<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DineFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

    
    
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="glass-effect w-full max-w-md p-6 sm:p-8 rounded-xl">
            <!-- Logo and Welcome Section -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-yellow-500 to-red-500 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 shadow-lg">
                    <i class="fas fa-utensils text-2xl sm:text-3xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Welcome Back</h2>
                <p class="text-center text-sm text-white">Sign in to your account</p>
            </div>

            <!-- Google Sign-In -->
            <a href="{{ route('google.login') }}"
               class="flex items-center justify-center gap-3 w-full py-3 glass-effect rounded-xl hover:bg-white/20 transition mb-6">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google logo" />
                <span class="text-sm font-medium text-white">Continue with Google</span>
            </a>

            <!-- Divider -->
            <div class="relative my-6">
                
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 glass-effect rounded-full text-white/60">or continue with email</span>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-white mb-1" for="email">Email</label>
                    <input class="w-full px-3 py-2 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                           id="email" 
                           type="email" 
                           name="email" 
                           placeholder="you@example.com"
                           required 
                           autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-white mb-1" for="password">Password</label>
                    <input class="w-full px-3 py-2 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                           id="password" 
                           type="password" 
                           name="password" 
                           placeholder="••••••••"
                           required>
                </div>

                <!-- Error Display -->
                @if ($errors->any())
                    <div class="text-red-400 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                               class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-500">
                        <span class="ml-2 text-white">Remember me</span>
                    </label>
                    <a href="#" class="text-yellow-500 hover:text-yellow-400 transition">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full px-4 py-3 bg-gradient-to-r from-yellow-500 to-red-500 hover:from-yellow-600 hover:to-red-600 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:scale-[.99] focus:ring-2 focus:ring-yellow-500">
                    Sign in
                </button>

                <!-- Register -->
                <p class="text-center text-sm text-white mt-6">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-400 font-medium">Register now</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
