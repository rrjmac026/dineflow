<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('orders.update', $order) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Order Details -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="table_number" :value="__('Table Number')" />
                                    <x-text-input id="table_number" class="block mt-1 w-full" type="number" name="table_number" :value="old('table_number', $order->table_number)" required />
                                    <x-input-error :messages="$errors->get('table_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="special_instructions" :value="__('Special Instructions')" />
                                    <textarea id="special_instructions" name="special_instructions" rows="3" 
                                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">{{ old('special_instructions', $order->special_instructions) }}</textarea>
                                    <x-input-error :messages="$errors->get('special_instructions')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                        @foreach(['pending', 'preparing', 'ready', 'completed', 'cancelled'] as $status)
                                            <option value="{{ $status }}" {{ old('status', $order->status) === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="payment_status" :value="__('Payment Status')" />
                                    <select id="payment_status" name="payment_status" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                        @foreach(['unpaid', 'paid', 'refunded'] as $status)
                                            <option value="{{ $status }}" {{ old('payment_status', $order->payment_status) === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="space-y-4">
                                <h3 class="font-medium text-lg">Order Items</h3>
                                <div id="order-items" class="space-y-4">
                                    @foreach($order->items as $index => $orderItem)
                                        <div class="flex gap-4 items-start">
                                            <div class="flex-1">
                                                <select name="items[{{ $index }}][menu_id]" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                                    @foreach($menuItems as $item)
                                                        <option value="{{ $item->id }}" data-price="{{ $item->price }}"
                                                            {{ $orderItem->menu_id === $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }} - ₱{{ number_format($item->price, 2) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="w-24">
                                                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $orderItem->quantity }}" min="1" 
                                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                            </div>
                                            <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" onclick="addItem()" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-amber-700 bg-amber-100 hover:bg-amber-200 dark:bg-amber-800 dark:text-amber-300 dark:hover:bg-amber-700 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Add Item
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-lg font-semibold">
                                Total: ₱<span id="total-price">{{ number_format($order->total_price, 2) }}</span>
                                <input type="hidden" name="total_price" id="total-price-input" value="{{ $order->total_price }}">
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update Order') }}</x-primary-button>
                                <a href="{{ route('orders.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemCount = {{ count($order->items) }};

        // ... Same JavaScript functions as in create.blade.php ...
    </script>
</x-app-layout>
