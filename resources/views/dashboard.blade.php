<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Customers Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Customers</p>
                                <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mt-2">
                                    {{ $data['total_customers'] }}
                                </p>
                            </div>
                            <div class="p-3 bg-amber-100 dark:bg-amber-800/30 rounded-full">
                                <i class="fas fa-users text-xl text-amber-600 dark:text-amber-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Orders</p>
                                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">
                                    {{ $data['total_orders'] }}
                                </p>
                                @if($data['pending_orders'] > 0)
                                    <span class="inline-block mt-2 px-2 py-1 text-xs bg-blue-100 dark:bg-blue-800/30 text-blue-600 dark:text-blue-400 rounded-full">
                                        {{ $data['pending_orders'] }} pending
                                    </span>
                                @endif
                            </div>
                            <div class="p-3 bg-blue-100 dark:bg-blue-800/30 rounded-full">
                                <i class="fas fa-shopping-cart text-xl text-blue-600 dark:text-blue-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Items Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Menu Items</p>
                                <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">
                                    {{ $data['total_menu_items'] }}
                                </p>
                            </div>
                            <div class="p-3 bg-green-100 dark:bg-green-800/30 rounded-full">
                                <i class="fas fa-utensils text-xl text-green-600 dark:text-green-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Inventory</p>
                                <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">
                                    {{ $data['total_inventory'] }}
                                </p>
                                @if($data['low_stock_items'] > 0)
                                    <span class="inline-block mt-2 px-2 py-1 text-xs bg-red-100 dark:bg-red-800/30 text-red-600 dark:text-red-400 rounded-full">
                                        {{ $data['low_stock_items'] }} low stock
                                    </span>
                                @endif
                            </div>
                            <div class="p-3 bg-red-100 dark:bg-red-800/30 rounded-full">
                                <i class="fas fa-boxes text-xl text-red-600 dark:text-red-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservations Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Reservations</p>
                                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2">
                                    {{ $data['total_reservations'] }}
                                </p>
                                @if($data['pending_reservations'] > 0)
                                    <span class="inline-block mt-2 px-2 py-1 text-xs bg-purple-100 dark:bg-purple-800/30 text-purple-600 dark:text-purple-400 rounded-full">
                                        {{ $data['pending_reservations'] }} pending
                                    </span>
                                @endif
                            </div>
                            <div class="p-3 bg-purple-100 dark:bg-purple-800/30 rounded-full">
                                <i class="fas fa-calendar-alt text-xl text-purple-600 dark:text-purple-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
