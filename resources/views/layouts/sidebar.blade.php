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
        class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-72 bg-gradient-to-b from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 border-r border-amber-200/50 dark:border-amber-800/50 shadow-xl z-40 flex flex-col">
        
        <!-- Main content wrapper with scrolling -->
        <div class="flex-1 overflow-y-auto">
            @if(auth()->user()->role === 'customer')
                @include('layouts.sidebar-customer')
            @else
                @include('layouts.sidebar-admin')
            @endif
        </div>

        <!-- Footer (not affected by scroll) -->
        <div class="p-4 flex-shrink-0">
            <div class="p-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-lg">
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-utensils"></i>
                    <span class="text-sm font-medium">DineFlow v1.0</span>
                </div>
            </div>
        </div>
    </aside>
</div>