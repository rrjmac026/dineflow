<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DineFlow</title>
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
                <h2 class="text-2xl font-bold text-white tracking-tight">Create Account</h2>
                <p class="mt-2 text-sm text-white/80">Join DineFlow today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="name">Name</label>
                    <input class="w-full px-3 py-2 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                           id="name" 
                           type="text" 
                           name="name" 
                           required 
                           autofocus>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="email">Email</label>
                    <input class="w-full px-3 py-2 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                           id="email" 
                           type="email" 
                           name="email" 
                           required>
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

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1" for="password_confirmation">Confirm Password</label>
                    <input class="w-full px-3 py-2 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                           id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
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
                        class="w-full px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:scale-[.99] focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                    Create Account
                </button>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-white/80">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-amber-400 hover:text-amber-300">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
