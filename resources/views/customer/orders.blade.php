<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">My Orders</h2>
                        <div class="flex gap-3">
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 text-sm font-medium rounded-full">
                                <i class="fas fa-list mr-1"></i> {{ $orders->total() }} Orders
                            </span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                <i class="fas fa-coins mr-1"></i> Total: ₱{{ number_format($orders->sum('total_price'), 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        @include('customer.partials.orders-table')
                    </div>
                    
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
