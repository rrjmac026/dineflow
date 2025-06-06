<div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Place Order</h3>
            <form method="POST" action="{{ route('customer.order') }}">
                @csrf
                <input type="hidden" name="menu_id" id="menu_id">
                
                <p class="text-sm mb-4">Selected Item: <span id="menuName" class="font-medium"></span></p>

                <div class="mb-4">
                    <label for="table_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Table Number</label>
                    <input type="number" name="table_number" id="table_number" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                </div>

                <div class="mb-4">
                    <label for="special_instructions" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Special Instructions</label>
                    <textarea name="special_instructions" id="special_instructions" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeOrderModal()"
                        class="px-4 py-2 text-gray-500 hover:text-gray-700">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
