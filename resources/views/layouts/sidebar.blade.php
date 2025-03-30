<div x-data class="relative min-h-screen">
    <!-- Sidebar backdrop -->
    <div 
        x-show="$store.sidebar.isOpen" 
        x-cloak
        class="fixed inset-0 z-40 lg:hidden"
        @click="$store.sidebar.toggle()">
        <div class="absolute inset-0 bg-amber-900/50 backdrop-blur-sm"></div>
    </div>

    <!-- Sidebar -->
    <div 
        x-show="$store.sidebar.isOpen"
        x-transition:enter="transition-transform ease-in-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        x-cloak
        class="fixed left-0 top-16 h-[calc(100vh-4rem)] w-64 bg-white dark:bg-gray-800 border-r border-amber-200 dark:border-amber-700 overflow-y-auto z-50">
        
        <div class="p-4 space-y-2">
            <!-- Dashboard -->
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
                   {{ request()->routeIs('dashboard') ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-800/50' }}">
                    <i class="fas fa-home w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Menu -->
            <a href="{{ route('menu.index') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
               {{ request()->routeIs('menu.*') ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-800/50' }}">
                <i class="fas fa-utensils w-5 h-5"></i>
                <span>Menu</span>
            </a>

            <!-- Orders -->
            <a href="{{ route('orders.index') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
               {{ request()->routeIs('orders.*') ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-800/50' }}">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
                <span>Orders</span>
            </a>

            <!-- Reservations -->
            <a href="{{ route('reservations.index') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
               {{ request()->routeIs('reservations.*') ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-800/50' }}">
                <i class="fas fa-calendar-alt w-5 h-5"></i>
                <span>Reservations</span>
            </a>

            <!-- Feedback -->
            <a href="{{ route('feedback.index') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
               {{ request()->routeIs('feedback.*') ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-800/50' }}">
                <i class="fas fa-comments w-5 h-5"></i>
                <span>Feedback</span>
            </a>

            <!-- Management Section -->
            <div class="mt-4 pt-4 border-t border-amber-200 dark:border-amber-700">
                <!-- Inventory -->
                <a href="{{ route('inventory.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
                   {{ request()->routeIs('inventory.*') ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-amber-800/50' }}">
                    <i class="fas fa-boxes w-5 h-5"></i>
                    <span>Inventory</span>
                </a>
        </div>

        <!-- Footer Info -->
        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-amber-100 dark:from-amber-800">
            <div class="flex items-center justify-center space-x-2 text-amber-600 dark:text-amber-300">
                <i class="fas fa-coffee text-sm"></i>
                <span class="text-xs font-medium">Serving Since 2024</span>
            </div>
        </div>
    </div>
</div>