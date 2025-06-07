<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Registration - DineFlow</title>
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
            z-index: -1;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        }
    </style>
</head>
<body class="antialiased min-h-screen overflow-x-hidden">
    <div class="bg-image"></div>

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-lg p-8 glass-effect rounded-xl my-8">
            <!-- Logo and Title - Keep your existing styles -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-store text-2xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Register New Tenant</h2>
                <p class="text-sm text-white/80 mt-2">Create your business on DineFlow</p>
            </div>

            <form method="POST" action="{{ route('superadmin.register') }}" class="space-y-5">
                @csrf

                <!-- Grid layout for form fields -->
                <div class="space-y-5">
                    <!-- Business Name -->
                    <div>
                        <label for="tenant_name" class="block text-sm font-medium text-white mb-1">Business Name</label>
                        <div class="relative">
                            <input id="tenant_name" name="tenant_name" type="text" required
                                   placeholder="Enter your business name"
                                   class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                        </div>
                    </div>

                    <!-- Two Column Grid -->
                    <div class="grid gap-5 grid-cols-1 md:grid-cols-2">
                        <!-- Subdomain -->
                        <div>
                            <label for="subdomain" class="block text-sm font-medium text-white mb-1">Subdomain</label>
                            <input id="subdomain" name="subdomain" type="text" required
                                   placeholder="your-business"
                                   class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                            <p class="text-xs text-white font-semibold mt-1">
                                <span class="text-white/50">Your URL will be:</span> 
                                <span class="text-white">yourbusiness.dineflow.com</span>
                            </p>
                        </div>

                        <!-- Plan -->
                        <div>
                            <label for="plan" class="block text-sm font-medium text-white mb-1">Choose Plan</label>
                            <select id="plan" name="plan" required
                                    class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="free">Free</option>
                                <option value="pro">Pro</option>
                            </select>
                        </div>
                    </div>

                    <!-- Admin Details -->
                    <div class="space-y-5">
                        <!-- Admin Name -->
                        <div>
                            <label for="admin_name" class="block text-sm font-medium text-white mb-1">Admin Name</label>
                            <input id="admin_name" name="admin_name" type="text" required
                                   placeholder="Full name"
                                   class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label for="admin_email" class="block text-sm font-medium text-white mb-1">Admin Email</label>
                            <input id="admin_email" name="admin_email" type="email" required
                                   placeholder="admin@example.com"
                                   class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                        </div>

                        <!-- Password Grid -->
                        <div class="grid gap-5 grid-cols-1 md:grid-cols-2">
                            <!-- Admin Password -->
                            <div>
                                <label for="admin_password" class="block text-sm font-medium text-white mb-1">Password</label>
                                <input id="admin_password" name="admin_password" type="password" required
                                       placeholder="••••••••"
                                       class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="admin_password_confirmation" class="block text-sm font-medium text-white mb-1">Confirm</label>
                                <input id="admin_password_confirmation" name="admin_password_confirmation" type="password" required
                                       placeholder="••••••••"
                                       class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                            </div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="text-red-400 text-sm mt-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full px-4 py-3 bg-gradient-to-r from-yellow-500 to-red-500 hover:from-yellow-600 hover:to-red-600 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:scale-[.99] focus:ring-2 focus:ring-yellow-500 mt-6">
                    Register Tenant
                </button>
            </form>
        </div>
    </div>
</body>
</html>
