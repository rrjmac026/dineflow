<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sales Report Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-amber-800 dark:text-amber-100 mb-4">
                            <i class="fas fa-chart-line mr-2"></i>Sales Report
                        </h3>
                        <p class="text-gray-700 dark:text-gray-400 mb-4">Generate detailed sales reports with filters for date ranges.</p>
                        <form action="{{ route('reports.sales') }}" method="GET" class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                                    <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                                    <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-amber-500 focus:ring-amber-500">
                                </div>
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-md shadow-sm hover:shadow transition-all duration-200">
                                <i class="fas fa-download mr-2"></i>Download Report
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Inventory Report Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-amber-800 dark:text-amber-100 mb-4">
                            <i class="fas fa-boxes mr-2"></i>Inventory Report
                        </h3>
                        <p class="text-gray-700 dark:text-gray-400 mb-4">Generate current inventory status report with stock levels.</p>
                        <form action="{{ route('reports.inventory') }}" method="GET">
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-md shadow-sm hover:shadow transition-all duration-200">
                                <i class="fas fa-download mr-2"></i>Download Report
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Feedback Report Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-amber-800 dark:text-amber-100 mb-4">
                            <i class="fas fa-comments mr-2"></i>Feedback Report
                        </h3>
                        <p class="text-gray-700 dark:text-gray-400 mb-4">Generate customer feedback and ratings report.</p>
                        <form action="{{ route('reports.feedback') }}" method="GET">
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-md shadow-sm hover:shadow transition-all duration-200">
                                <i class="fas fa-download mr-2"></i>Download Report
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
