<x-guest-layout>
                    <!-- Logo -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <i class="fas fa-utensils text-3xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                    Welcome Back!
                </h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Sign in to continue to DineFlow
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Google Login -->
            <div class="mb-6">
                <a href="{{ route('google.login') }}" 
                   class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-200 transition duration-200 hover:bg-gray-50 dark:hover:bg-gray-600 hover:border-amber-500 dark:hover:border-amber-400">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z"/>
                    </svg>
                    Continue with Google
                </a>
            </div>

            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        or continue with email
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" 
                               class="rounded-md border-gray-300 dark:border-gray-700 text-amber-500 focus:ring-amber-500 dark:focus:ring-amber-400 dark:bg-gray-800"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 transition-colors"
                           href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <div>
                    <button type="submit" 
                            class="w-full px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:scale-[.99] focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Sign in
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                           class="text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 transition-colors">
                            Register now
                        </a>
                    </p>
                </div>
            </form>
</x-guest-layout>