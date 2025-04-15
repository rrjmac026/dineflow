<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ tenant('name') }} - DineFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to {{ tenant('name') }}</h1>
        <p class="text-gray-600 mb-8">Your restaurant management system</p>
        
        <div class="space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Login
                </a>
            @endauth
        </div>
    </div>
</body>
</html>
