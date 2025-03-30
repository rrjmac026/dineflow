<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order Details') }}
            </h2>
            <a href="{{ route('orders.edit', $order) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Order
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Order Information -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Order Information</h3>
                                <div class="mt-4 space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Order ID:</span>
                                            <p class="mt-1">#{{ $order->id }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Table Number:</span>
                                            <p class="mt-1">{{ $order->table_number }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                            <p class="mt-1">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $order->status === 'completed' 
                                                        ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                        : ($order->status === 'cancelled' 
                                                            ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                                            : 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Status:</span>
                                            <p class="mt-1">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $order->payment_status === 'paid' 
                                                        ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    @if($order->special_instructions)
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Special Instructions:</span>
                                            <p class="mt-1">{{ $order->special_instructions }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Order Items</h3>
                            <div class="space-y-2">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                        <div class="flex-1">
                                            <h4 class="font-medium">{{ $item->menu->name }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->quantity }} × ₱{{ number_format($item->unit_price, 2) }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">₱{{ number_format($item->subtotal, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Total:</span>
                                    <span class="text-lg font-bold text-amber-600 dark:text-amber-400">
                                        ₱{{ number_format($order->total_price, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
