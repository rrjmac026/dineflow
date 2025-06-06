<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 leading-tight">
            {{ __('Inventory Management') }}
        </h2>
    </x-slot>

    <div class="flex justify-end px-8 mt-4">
        <a href="{{ route('inventory.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg shadow-sm hover:shadow transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>Add Item
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                <div class="p-6 text-gray-700 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md dark:bg-green-900 dark:border-green-800 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-amber-50 dark:bg-amber-900/20 border-b border-amber-200 dark:border-amber-700">
                                <tr>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Item Name</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Quantity</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Supplier</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Status</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($inventory as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-amber-800/50 transition-colors duration-150">
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">{{ $item->item_name }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">{{ $item->quantity }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">{{ $item->supplier }}</td>
                                        <td class="py-4 px-6 text-sm">
                                            @if($item->quantity <= $item->reorder_level)
                                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    Low Stock
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    In Stock
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm space-x-2">
                                            <a href="{{ route('inventory.show', $item) }}" class="text-amber-700 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 transition-colors duration-150">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('inventory.edit', $item) }}" class="text-blue-700 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('inventory.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-6 text-sm text-center text-gray-600 dark:text-gray-400">
                                            No inventory items found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
