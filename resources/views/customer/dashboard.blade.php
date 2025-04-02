<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Hero Section -->
            <div class="relative overflow-hidden rounded-2xl mb-6">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-600 opacity-90"></div>
                <div class="relative p-8 sm:p-12">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                        <div class="text-white">
                            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h1>
                            <p class="text-amber-100 text-lg">Discover our delicious menu and place your order today.</p>
                        </div>
                        <!-- <div class="flex-shrink-0">
                            <img src="{{ asset('images/hero-food.png') }}" alt="Hero" class="w-32 h-32 object-cover rounded-full border-4 border-white/20">
                        </div> -->
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 px-6 py-4 bg-green-100 border-l-4 border-green-500 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Menu Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Featured Menu</h2>
                        <a href="{{ route('customer.menu') }}" class="text-amber-600 hover:text-amber-700 dark:hover:text-amber-400 transition-colors">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($menuItems->take(6) as $item)
                            <div class="group bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="relative">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" 
                                         class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute top-2 right-2">
                                        <span class="px-3 py-1 bg-amber-500 text-white text-xs font-semibold rounded-full">
                                            {{ ucfirst($item->category) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">{{ $item->name }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ $item->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-amber-600 dark:text-amber-400 text-lg font-bold">₱{{ number_format($item->price, 2) }}</span>
                                        <form method="POST" action="{{ route('customer.order') }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $item->id }}">
                                            <button type="submit" 
                                                class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                Order Now
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
