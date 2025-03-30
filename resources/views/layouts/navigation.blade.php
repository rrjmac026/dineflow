<div x-data="{ darkMode: $store.darkMode.on, open: false }">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-30 fixed top-0 left-0 right-0 h-16">
        <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center gap-4">
                <!-- Sidebar Toggle -->
                <button @click="$store.sidebar.toggle()" 
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                    <i class="fas" :class="$store.sidebar.isOpen ? 'fa-times' : 'fa-bars'"></i>
                </button>
                
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="hover:opacity-90 transition-opacity duration-150">
                    <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-white">
                        Dine<span class="text-amber-500">Flow</span>
                    </span>
                </a>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <!-- Profile Button -->
                <button @click="open = !open" 
                        class="flex items-center text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white focus:outline-none">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <i class="fas fa-caret-down"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg py-2 z-50">
                    
                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>

                    <!-- Dark Mode Toggle -->
                    <button @click="$store.darkMode.toggle()"
                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <i x-show="$store.darkMode.on" class="fas fa-sun mr-2"></i>
                        <i x-show="!$store.darkMode.on" class="fas fa-moon mr-2"></i>
                        <span x-text="$store.darkMode.on ? 'Light Mode' : 'Dark Mode'"></span>
                    </button>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
