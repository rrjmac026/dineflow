<div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-amber-700 dark:text-amber-200 uppercase tracking-wider">Order #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-amber-700 dark:text-amber-200 uppercase tracking-wider">Item</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-amber-700 dark:text-amber-200 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-amber-700 dark:text-amber-200 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-amber-700 dark:text-amber-200 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-amber-700 dark:text-amber-200 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($orders as $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-medium text-amber-600 dark:text-amber-400">#{{ $order->order_number }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ Storage::url($order->menu->image) }}" class="w-10 h-10 rounded-lg object-cover">
                            <span class="font-medium">{{ $order->menu->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                        <i class="far fa-clock mr-1"></i>
                        {{ $order->created_at->format('M d, Y h:i A') }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusColors = [
                                'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
                                'preparing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'completed' => 'bg-green-100 text-green-800 border-green-200',
                                'cancelled' => 'bg-red-100 text-red-800 border-red-200'
                            ];
                            $statusIcons = [
                                'pending' => 'fa-clock',
                                'preparing' => 'fa-kitchen-set',
                                'completed' => 'fa-check',
                                'cancelled' => 'fa-times'
                            ];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium border {{ $statusColors[$order->status] }}">
                            <i class="fas {{ $statusIcons[$order->status] }}"></i>
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium">₱{{ number_format($order->total_price, 2) }}</td>
                    <td class="px-6 py-4">
                        @if(in_array($order->status, ['pending', 'preparing']))
                            <form action="{{ route('customer.orders.cancel', $order) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    onclick="return confirm('Are you sure you want to cancel this order?')"
                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Cancel Order
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="text-amber-500 mb-4">
                                <i class="fas fa-shopping-cart text-6xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Orders Yet</h3>
                            <p class="text-gray-500 dark:text-gray-400">Browse our menu to place your first order!</p>
                            <a href="{{ route('customer.menu') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors">
                                <i class="fas fa-utensils mr-2"></i> View Menu
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
