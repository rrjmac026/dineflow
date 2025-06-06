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
    </style>
</head>
<body class="antialiased min-h-screen overflow-x-hidden">
    <div class="bg-image"></div>
    
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="glass-effect w-full max-w-md p-6 sm:p-8 rounded-xl">
            <!-- Logo and Welcome Section -->
            <div class="flex flex-col items-center mb-8">
                <h2 class="text-2xl font-bold text-white tracking-tight">Welcome Back!</h2>
                <p class="mt-2 text-sm text-white/80">Sign in to continue to DineFlow</p>
            </div>

            <!-- Google Login -->
            <div class="mb-6">
                <a href="{{ route('google.login') }}" 
                   class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-sm font-medium text-white transition duration-200">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z"/>
                    </svg>
                    Continue with Google
                </a>
            </div>

            <!-- Divider -->
            <div class="relative mb-8">
                <!-- <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/20"></div>
                </div> -->
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 glass-effect text-white/80">or continue with email</span>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="email">Email</label>
                    <input class="w-full px-3 py-2 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                           id="email" 
                           type="email" 
                           name="email" 
                           required 
                           autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="password">Password</label>
                    <input class="w-full px-3 py-2 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                           id="password" 
                           type="password" 
                           name="password" 
                           required>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-amber-500 focus:ring-amber-500" name="remember">
                        <span class="ml-2 text-sm text-white/80">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-amber-600 hover:text-amber-800">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:scale-[.99] focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                    Sign in
                </button>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm text-white/80">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-800">
                            Register now
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
