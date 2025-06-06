<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 leading-tight">
            {{ __('Feedback Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 sm:rounded-lg">
                <div class="p-6 text-gray-700 dark:text-gray-100">
                    
                    @if (session('success'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md dark:bg-green-900 dark:border-green-800 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-amber-50 dark:bg-amber-900/20 border-b border-amber-200 dark:border-amber-700">
                                <tr>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">User</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Rating</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Message</th>
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Date</th>
                                    @if(auth()->user()->role === 'management')
                                    <th class="py-3 px-6 text-left text-sm font-medium text-amber-900 dark:text-amber-100">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($feedbacks as $feedback)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-amber-800/50 transition-colors duration-150">
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">
                                            {{ $feedback->user->name }}
                                        </td>
                                        <td class="py-4 px-6 text-sm">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-amber-400' : 'text-gray-300 dark:text-gray-600' }}"></i>
                                                @endfor
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">
                                            {{ $feedback->message }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-200">
                                            {{ $feedback->created_at->format('M d, Y h:i A') }}
                                        </td>
                                        @if(auth()->user()->role === 'management')
                                        <td class="py-4 px-6 text-sm">
                                            <form action="{{ route('feedback.destroy', $feedback) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-700 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150"
                                                    onclick="return confirm('Are you sure you want to delete this feedback?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-6 text-sm text-center text-gray-600 dark:text-gray-400">
                                            No feedback found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
