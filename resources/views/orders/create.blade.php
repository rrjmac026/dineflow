<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Order Details -->
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="table_number" :value="__('Table Number')" />
                                    <x-text-input id="table_number" class="block mt-1 w-full" type="number" name="table_number" :value="old('table_number')" required />
                                    <x-input-error :messages="$errors->get('table_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="special_instructions" :value="__('Special Instructions')" />
                                    <textarea id="special_instructions" name="special_instructions" rows="3" 
                                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">{{ old('special_instructions') }}</textarea>
                                    <x-input-error :messages="$errors->get('special_instructions')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="space-y-4">
                                <h3 class="font-medium text-lg">Order Items</h3>
                                <div id="order-items" class="space-y-4">
                                    <div class="flex gap-4 items-start">
                                        <div class="flex-1">
                                            <select name="items[0][menu_id]" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                                @foreach($menuItems as $item)
                                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                                        {{ $item->name }} - ₱{{ number_format($item->price, 2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-24">
                                            <input type="number" name="items[0][quantity]" value="1" min="1" 
                                                   class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                        </div>
                                        <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="button" onclick="addItem()" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-amber-700 bg-amber-100 hover:bg-amber-200 dark:bg-amber-800 dark:text-amber-300 dark:hover:bg-amber-700 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Add Item
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-lg font-semibold">
                                Total: ₱<span id="total-price">0.00</span>
                                <input type="hidden" name="total_price" id="total-price-input" value="0">
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create Order') }}</x-primary-button>
                                <a href="{{ route('orders.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemCount = 1;

        function addItem() {
            const template = `
                <div class="flex gap-4 items-start">
                    <div class="flex-1">
                        <select name="items[${itemCount}][menu_id]" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            @foreach($menuItems as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                    {{ $item->name }} - ₱{{ number_format($item->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-24">
                        <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    </div>
                    <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.getElementById('order-items').insertAdjacentHTML('beforeend', template);
            itemCount++;
            updateTotal();
        }

        function removeItem(button) {
            button.closest('.flex').remove();
            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            const items = document.getElementById('order-items').children;
            
            for (let item of items) {
                const select = item.querySelector('select');
                const quantity = item.querySelector('input[type="number"]').value;
                const price = select.options[select.selectedIndex].dataset.price;
                total += price * quantity;
            }

            document.getElementById('total-price').textContent = total.toFixed(2);
            document.getElementById('total-price-input').value = total;
        }

        // Add event listeners for changes
        document.getElementById('order-items').addEventListener('change', updateTotal);
        document.getElementById('order-items').addEventListener('input', updateTotal);
    </script>
</x-app-layout>
