<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Menu Item Details') }}
            </h2>
            <a href="{{ route('menu.edit', $menu) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Item
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->name }}" 
                                 class="w-full h-96 object-cover rounded-lg shadow-md">
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $menu->name }}</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $menu->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Price:</span>
                                    <p class="mt-1 text-lg font-semibold">₱{{ number_format($menu->price, 2) }}</p>
                                </div>

                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Category:</span>
                                    <p class="mt-1 capitalize">{{ $menu->category }}</p>
                                </div>

                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                    <p class="mt-1">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $menu->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ ucfirst($menu->status) }}
                                        </span>
                                    </p>
                                </div>

                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated:</span>
                                    <p class="mt-1">{{ $menu->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom back button -->
                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('menu.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
