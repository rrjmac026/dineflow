<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Inventory Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('inventory.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="item_name" :value="__('Item Name')" />
                                <x-text-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name')" required autofocus />
                                <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity', 0)" required />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="supplier" :value="__('Supplier')" />
                                <x-text-input id="supplier" class="block mt-1 w-full" type="text" name="supplier" :value="old('supplier')" required />
                                <x-input-error :messages="$errors->get('supplier')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="unit_cost" :value="__('Unit Cost')" />
                                <x-text-input id="unit_cost" class="block mt-1 w-full" type="number" name="unit_cost" step="0.01" :value="old('unit_cost')" />
                                <x-input-error :messages="$errors->get('unit_cost')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="reorder_level" :value="__('Reorder Level')" />
                                <x-text-input id="reorder_level" class="block mt-1 w-full" type="number" name="reorder_level" :value="old('reorder_level', 10)" required />
                                <x-input-error :messages="$errors->get('reorder_level')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Add Item') }}</x-primary-button>
                            <a href="{{ route('inventory.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
