<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md dark:bg-green-900 dark:border-green-800 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Category Filters -->
                    <div class="mb-6 flex gap-2">
                        <button onclick="filterMenu('all')" class="category-filter active px-4 py-2 rounded-lg bg-amber-500 text-white hover:bg-amber-600">
                            All
                        </button>
                        @foreach(['main', 'appetizer', 'dessert', 'beverage'] as $category)
                            <button onclick="filterMenu('{{ $category }}')" 
                                class="category-filter px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                {{ ucfirst($category) }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Menu Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($menuItems as $item)
                            <div class="menu-item bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden" data-category="{{ $item->category }}">
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h4 class="font-semibold text-lg mb-2">{{ $item->name }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $item->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-amber-600 dark:text-amber-400 font-bold">₱{{ number_format($item->price, 2) }}</span>
                                        <form method="POST" action="{{ route('customer.order') }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $item->id }}">
                                            <button type="submit" 
                                                class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                Order Now
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @push('scripts')
    <script>
        function filterMenu(category) {
            document.querySelectorAll('.category-filter').forEach(btn => {
                btn.classList.remove('bg-amber-500', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-700', 'dark:text-gray-300');
            });

            const button = event.currentTarget;
            button.classList.remove('bg-gray-200', 'text-gray-700', 'dark:bg-gray-700', 'dark:text-gray-300');
            button.classList.add('bg-amber-500', 'text-white');

            document.querySelectorAll('.menu-item').forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
