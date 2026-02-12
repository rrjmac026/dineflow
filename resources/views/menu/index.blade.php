<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 leading-tight">
            {{ __('Menu Management') }}
        </h2>
    </x-slot>

    <div class="flex justify-end px-8 mt-4">
        <a href="{{ route('menu.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg shadow-sm hover:shadow transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>Add Menu Item
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md dark:bg-green-900 dark:border-green-800 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                        @forelse($menu as $item)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
                                {{-- ✅ This respects tenant storage --}}
                                <img src="{{ asset('storage/' . tenant()->id . '/' . $item->image) }}" alt="{{ $item->name }}" 
                                    class="w-full h-48 object-cover hover:opacity-90 transition-opacity duration-200">
                                <div class="p-4 space-y-2">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                            {{ $item->name }}
                                        </h3>
                                        <span class="text-amber-700 dark:text-amber-400 font-bold">
                                            ₱{{ number_format($item->price, 2) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $item->description }}</p>
                                    <div class="flex justify-between items-center pt-2">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $item->status === 'available' ? 'bg-green-50 text-green-700 dark:bg-green-900 dark:text-green-200' : 'bg-red-50 text-red-700 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                        <div class="flex space-x-3">
                                            <a href="{{ route('menu.show', $item) }}" 
                                               class="text-amber-700 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 transition-colors duration-150">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('menu.edit', $item) }}" 
                                               class="text-blue-700 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('menu.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 text-gray-600 dark:text-gray-400">
                                No menu items found
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
