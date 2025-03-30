<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Orders Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-2 bg-amber-100 dark:bg-amber-900 rounded-lg">
                                    <i class="fas fa-shopping-cart text-amber-600 dark:text-amber-400 text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Orders</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['total_orders'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservations Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                    <i class="fas fa-calendar-alt text-blue-600 dark:text-blue-400 text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Reservations</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['total_reservations'] }}</p>
                                </div>
                            </div>
                            @if($data['pending_reservations'] > 0)
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                                    {{ $data['pending_reservations'] }} pending
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Menu Items Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                                <i class="fas fa-utensils text-green-600 dark:text-green-400 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Menu Items</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['total_menu_items'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                                    <i class="fas fa-boxes text-red-600 dark:text-red-400 text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Inventory Items</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $data['total_inventory'] }}</p>
                                </div>
                            </div>
                            @if($data['low_stock_items'] > 0)
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full">
                                    {{ $data['low_stock_items'] }} low stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
