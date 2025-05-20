<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-6">
                        <!-- Order Information -->
                        <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Order Information</h3>
                            <div class="mt-4 grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Order Number:</span>
                                    <p class="mt-1">#{{ $order->order_number }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Customer:</span>
                                    <p class="mt-1">{{ $order->user->name }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Table Number:</span>
                                    <p class="mt-1">{{ $order->table_number }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                    <p class="mt-1">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Status:</span>
                                    <p class="mt-1">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Item -->
                        <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Menu Item</h3>
                            <div class="mt-4">
                                <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-800 rounded-lg border border-amber-100 dark:border-amber-900/50">
                                    <div>
                                        <h4 class="font-medium">{{ $order->menu->name }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->menu->description }}</p>
                                    </div>
                                    <p class="font-medium">₱{{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        @if($order->special_instructions)
                            <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-4">
                                <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Special Instructions</h3>
                                <p class="mt-2">{{ $order->special_instructions }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
