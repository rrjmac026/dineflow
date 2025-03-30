<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('reservations.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" 
                                    :value="old('date')" 
                                    min="{{ now()->format('Y-m-d') }}"
                                    required />
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="time" :value="__('Time')" />
                                <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" 
                                    :value="old('time')"
                                    required />
                                <x-input-error :messages="$errors->get('time')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="guests" :value="__('Number of Guests')" />
                                <x-text-input id="guests" class="block mt-1 w-full" type="number" name="guests" 
                                    :value="old('guests')" min="1" required />
                                <x-input-error :messages="$errors->get('guests')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" 
                                    :value="old('contact_number')" required />
                                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="special_requests" :value="__('Special Requests (Optional)')" />
                                <textarea id="special_requests" name="special_requests" rows="3" 
                                    class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm"
                                >{{ old('special_requests') }}</textarea>
                                <x-input-error :messages="$errors->get('special_requests')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create Reservation') }}</x-primary-button>
                            <a href="{{ route('reservations.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
