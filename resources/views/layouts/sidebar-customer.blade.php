<nav class="p-4 space-y-1.5">
    <!-- Main Menu -->
    <div class="mb-6">
        <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
            Menu
        </span>
        <div class="mt-2 space-y-1">
            <a href="{{ route('customer.dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('customer.dashboard') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-home w-5 h-5"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('customer.menu') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('customer.menu') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-utensils w-5 h-5"></i>
                <span>Menu</span>
            </a>
            <a href="{{ route('customer.reservations') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('customer.reservations*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-calendar-alt w-5 h-5"></i>
                <span>My Reservations</span>
            </a>
        </div>
    </div>

    <!-- Orders -->
    <div class="mb-6">
        <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
            Orders
        </span>
        <div class="mt-2 space-y-1">
            <a href="{{ route('customer.orders') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('customer.orders') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
                <span>My Orders</span>
            </a>
        </div>
    </div>

    <!-- Feedback -->
    <div class="mb-6">
        <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
            Feedback
        </span>
        <div class="mt-2 space-y-1">
            <a href="{{ route('customer.feedback') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('customer.feedback') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-star w-5 h-5"></i>
                <span>Give Feedback</span>
            </a>
        </div>
    </div>
</nav>
