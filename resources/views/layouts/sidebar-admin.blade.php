<nav class="p-4 space-y-1.5">
    <!-- Main Menu -->
    <div class="mb-6">
        <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
            Menu
        </span>
        <div class="mt-2 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-home w-5 h-5"></i>
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
            {{-- Show Orders link to admin and staff --}}
            @if(in_array(auth()->user()->role, ['admin', 'staff', 'manager']))
            <a href="{{ route('orders.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('orders.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
                <span>Orders</span>
            </a>
            @endif

            {{-- Show Reservations link to admin and manager --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager']))
            <a href="{{ route('reservations.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('reservations.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-calendar-alt w-5 h-5"></i>
                <span>Reservations</span>
            </a>
            @endif

            {{-- Show Feedback link only to admin --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('feedback.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('feedback.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-star w-5 h-5"></i>
                <span>Feedback</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Management -->
    <div class="mb-6">
        <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
            Management
        </span>
        <div class="mt-2 space-y-1">
            {{-- Show Menu link only to admin --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('menu.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('menu.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-utensils w-5 h-5"></i>
                <span>Menu</span>
            </a>
            @endif

            {{-- Show Customers link to admin and staff --}}
            @if(in_array(auth()->user()->role, ['admin', 'staff']))
            <a href="{{ route('customers.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-users w-5 h-5"></i>
                <span>Customers</span>
            </a>
            @endif

            {{-- Show Inventory link to admin and manager --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager']))
            <a href="{{ route('inventory.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('inventory.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-boxes w-5 h-5"></i>
                <span>Inventory</span>
            </a>
            @endif

            {{-- Show Users link only to admin --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-users-cog w-5 h-5"></i>
                <span>Users</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Reports -->
    <div class="mb-6">
        <span class="px-3 text-xs font-semibold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
            Reports
        </span>
        <div class="mt-2 space-y-1">
            {{-- Show Reports link only to admin --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('reports.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 
               {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-amber-900 dark:text-amber-100 hover:bg-amber-500/10 dark:hover:bg-amber-500/10' }}">
                <i class="fas fa-chart-bar w-5 h-5"></i>
                <span>Reports</span>
            </a>
            @endif
        </div>
    </div>

    <script>
        function confirmDelete(formId) {
            if (confirm('Are you sure you want to delete this item?')) {
                document.getElementById(formId).submit();
            }
            return false;
        }

        function confirmAction(message, formId) {
            if (confirm(message)) {
                document.getElementById(formId).submit();
            }
            return false;
        }
    </script>
</nav>
