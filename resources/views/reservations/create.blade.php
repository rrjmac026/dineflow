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
                                <select id="time" name="time" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm" required>
                                    @foreach(['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'] as $timeSlot)
                                        <option value="{{ $timeSlot }}" {{ old('time') === $timeSlot ? 'selected' : '' }}>
                                            {{ date('h:i A', strtotime($timeSlot)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('time')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="guests" :value="__('Number of Guests')" />
                                <x-text-input id="guests" class="block mt-1 w-full" type="number" name="guests" 
                                    :value="old('guests', 1)" min="1" max="20" required />
                                <x-input-error :messages="$errors->get('guests')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" class="block mt-1 w-full" type="tel" name="contact_number" 
                                    :value="old('contact_number')" required pattern="[0-9]{11}" placeholder="09123456789" />
                                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm">
                                    @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" {{ old('status', 'pending') === $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="special_requests" :value="__('Special Requests (Optional)')" />
                                <textarea id="special_requests" name="special_requests" rows="3" maxlength="500"
                                    class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm"
                                    placeholder="Any special arrangements or requests...">{{ old('special_requests') }}</textarea>
                                <x-input-error :messages="$errors->get('special_requests')" class="mt-2" />
                            </div>
                        </div>

                        <input type="hidden" name="status" value="pending">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

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
