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

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Order Details -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="order_number" :value="__('Order Number')" />
                                    <x-text-input id="order_number" class="block mt-1 w-full bg-gray-100" 
                                        type="text" 
                                        name="order_number" 
                                        :value="$order->order_number" 
                                        readonly 
                                        required />
                                    <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                                </div>
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

                                <div>
                                    <x-input-label for="menu_id" :value="__('Menu Item')" />
                                    <select id="menu_id" name="menu_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                        @foreach($menuItems as $menu)
                                            <option value="{{ $menu->id }}" {{ old('menu_id', $order->menu_id) == $menu->id ? 'selected' : '' }}>
                                                {{ $menu->name }} - ₱{{ number_format($menu->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="total_price" :value="__('Total Price')" />
                                    <x-text-input id="total_price" class="block mt-1 w-full" type="number" name="total_price" :value="old('total_price', $order->total_price)" step="0.01" required />
                                    <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
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
</x-app-layout>
