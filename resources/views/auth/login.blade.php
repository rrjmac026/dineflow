<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - DineFlow</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .bg-image {
      background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/background.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      position: fixed;
      inset: 0;
      z-index: -1;
    }

    input::placeholder {
      color: #a0aec0; /* Tailwind's gray-400 */
    }

    .card-shadow {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="antialiased text-gray-800 min-h-screen overflow-x-hidden bg-gray-50">
  <div class="bg-image"></div>

  <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-10 rounded-2xl card-shadow w-full max-w-md">

      <!-- Header -->
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
        <p class="text-sm text-gray-500 mt-2">Login to continue to <span class="font-semibold text-amber-500">DineFlow</span></p>
      </div>

      <!-- Google Sign-In -->
      <a href="{{ route('google.login') }}"
         class="flex items-center justify-center gap-3 w-full py-3 border border-gray-300 rounded-xl hover:border-amber-500 hover:bg-gray-50 transition">
        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google logo" />
        <span class="text-sm font-medium text-gray-700">Continue with Google</span>
      </a>

      <!-- Divider -->
      <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
          <span class="px-4 bg-white text-gray-400">or continue with email</span>
        </div>
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Field -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input id="email" type="email" name="email" required autofocus
                 placeholder="you@example.com"
                 class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent" />
        </div>

        <!-- Password Field -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input id="password" type="password" name="password" required
                 placeholder="••••••••"
                 class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent" />
        </div>

        <!-- Error Display -->
        @if ($errors->any())
          <div class="text-red-500 text-sm">
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between text-sm">
          <label class="inline-flex items-center">
            <input type="checkbox" name="remember"
                   class="rounded border-gray-300 text-amber-500 focus:ring-amber-500" />
            <span class="ml-2 text-gray-600">Remember me</span>
          </label>
          <a href="#" class="text-amber-500 hover:text-orange-500 transition">Forgot password?</a>
        </div>

        <!-- Submit -->
        <button type="submit" class="w-full py-3 mt-2 bg-blue-500 text-white rounded-lg">
  Sign in
</button>


        <!-- Register -->
        <p class="text-center text-sm text-gray-600 mt-6">
          Don’t have an account?
          <a href="{{ route('register') }}" class="text-amber-500 hover:text-orange-500 font-medium">Register now</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
