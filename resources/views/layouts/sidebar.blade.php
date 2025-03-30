<div x-data class="h-full">
    <!-- Backdrop -->
    <div x-show="$store.sidebar.isOpen" x-cloak
        class="fixed inset-0 z-40 bg-black/20 backdrop-blur-sm lg:hidden"
        @click="$store.sidebar.toggle()">
    </div>

    <!-- Sidebar -->
    <aside x-show="$store.sidebar.isOpen" x-cloak
        x-transition:enter="transform transition-transform duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition-transform duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-72 bg-gradient-to-b from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 border-r border-amber-200/50 dark:border-amber-800/50 shadow-xl z-40 overflow-y-auto">
        
        <!-- Navigation -->
        <nav class="p-4 space-y-1.5">
            <!-- Main Menu -->
            <div class="mb-6">
                <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
                    Main Menu
                </span>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
                       {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                        <i class="fas fa-chart-pie w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Orders & Service -->
            <div class="mb-6">
                <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
                    Orders & Service
                </span>
                <div class="mt-2 space-y-1">
                    @foreach([
                        ['route' => 'menu.index', 'icon' => 'fas fa-utensils', 'name' => 'Menu'],
                        ['route' => 'orders.index', 'icon' => 'fas fa-shopping-cart', 'name' => 'Orders'],
                        ['route' => 'reservations.index', 'icon' => 'fas fa-calendar-alt', 'name' => 'Reservations'],
                        ['route' => 'feedback.index', 'icon' => 'fas fa-comments', 'name' => 'Feedback']
                    ] as $item)
                        <a href="{{ route($item['route']) }}" 
                           class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
                           {{ request()->routeIs($item['route'].'*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                            <i class="{{ $item['icon'] }} w-5 h-5"></i>
                            <span>{{ $item['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Management -->
            
            <div class="mb-6">
                <span class="px-3 text-xs font-semibold text-amber-600 dark:text-amber-400 uppercase tracking-wider">
                    Management
                </span>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('inventory.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-colors duration-200 
                       {{ request()->routeIs('inventory.*') ? 'bg-gradient-to-r from-amber-50 to-amber-100/50 text-amber-900 dark:from-amber-900/50 dark:to-amber-800/30 dark:text-amber-100' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-900/30' }}">
                        <i class="fas fa-boxes w-5 h-5"></i>
                        <span>Inventory</span>
                    </a>
                </div>
            </div>
            
        </nav>

        <!-- Footer -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="p-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-lg">
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-utensils"></i>
                    <span class="text-sm font-medium">DineFlow v1.0</span>
                </div>
            </div>
        </div>
    </aside>
</div>