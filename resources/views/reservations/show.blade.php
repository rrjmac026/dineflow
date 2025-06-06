<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Reservation Details') }}
            </h2>
            <a href="{{ route('reservations.edit', $reservation) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Reservation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Customer Information</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Name:</span>
                                        <p class="mt-1">{{ $reservation->user->name }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Number:</span>
                                        <p class="mt-1">{{ $reservation->contact_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Reservation Details</h3>
                                <div class="mt-4 space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Date:</span>
                                            <p class="mt-1">{{ $reservation->date->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Time:</span>
                                            <p class="mt-1">{{ $reservation->time->format('h:i A') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Guests:</span>
                                            <p class="mt-1">{{ $reservation->guests }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Table Number:</span>
                                            <p class="mt-1">{{ $reservation->table_number ?? 'Not assigned' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-amber-900 dark:text-amber-100">Status Information</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                        <p class="mt-1">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $reservation->status === 'confirmed' 
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                    : ($reservation->status === 'cancelled' 
                                                        ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                                        : 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200') }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    @if($reservation->special_requests)
                                        <div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Special Requests:</span>
                                            <p class="mt-1">{{ $reservation->special_requests }}</p>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Created On:</span>
                                        <p class="mt-1">{{ $reservation->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated:</span>
                                        <p class="mt-1">{{ $reservation->updated_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Reservations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
