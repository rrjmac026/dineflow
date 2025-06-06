@inject('users', 'App\Models\User')
@inject('menus', 'App\Models\Menu')

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

                        <!-- Order Details -->
                        <div class="space-y-6 border-b border-amber-200 dark:border-amber-700 pb-6">
                            <div>
                                <x-input-label for="order_number" :value="__('Order Number')" />
                                <x-text-input id="order_number" class="block mt-1 w-full bg-gray-100" 
                                    type="text" 
                                    name="order_number" 
                                    :value="App\Models\Order::generateOrderNumber()" 
                                    readonly 
                                    required />
                                <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="user_id" :value="__('Customer')" />
                                <select id="user_id" name="user_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                    @foreach($users::where('role', 'customer')->get() as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="menu_id" :value="__('Menu Item')" />
                                <select id="menu_id" name="menu_id" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                    @foreach($menus::where('status', 'available')->get() as $menu)
                                        <option value="{{ $menu->id }}" data-price="{{ $menu->price }}" {{ old('menu_id') == $menu->id ? 'selected' : '' }}>
                                            {{ $menu->name }} - ₱{{ number_format($menu->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('menu_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="total_price" :value="__('Total Price')" />
                                <x-text-input id="total_price" class="block mt-1 w-full" type="number" name="total_price" :value="old('total_price', 0)" step="0.01" required />
                                <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="table_number" :value="__('Table Number')" />
                                <x-text-input id="table_number" class="block mt-1 w-full" type="number" name="table_number" :value="old('table_number')" required />
                                <x-input-error :messages="$errors->get('table_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Order Status')" />
                                <select id="status" name="status" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="preparing" {{ old('status') === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="payment_status" :value="__('Payment Status')" />
                                <select id="payment_status" name="payment_status" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                    <option value="unpaid" {{ old('payment_status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ old('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="refunded" {{ old('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="special_instructions" :value="__('Special Instructions')" />
                                <textarea id="special_instructions" name="special_instructions" rows="3" 
                                    class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">{{ old('special_instructions') }}</textarea>
                                <x-input-error :messages="$errors->get('special_instructions')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-600 dark:bg-amber-500 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-amber-700 dark:hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Create Order') }}
                            </button>
                            <a href="{{ route('orders.index') }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 text-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
