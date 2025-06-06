<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Feedback Form -->
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl shadow-xl overflow-hidden mb-6">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Share Your Experience</h2>
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                        @include('customer.partials.feedback-form')
                    </div>
                </div>
            </div>

            <!-- Previous Feedbacks -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Your Previous Feedbacks</h2>
                    <div class="grid gap-6">
                        @forelse($feedbacks as $feedback)
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-xl {{ $i <= $feedback->rating ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        <i class="far fa-clock mr-1"></i>
                                        {{ $feedback->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">{{ $feedback->message }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="text-amber-500 mb-4">
                                    <i class="far fa-comment-dots text-6xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Feedback Yet</h3>
                                <p class="text-gray-500 dark:text-gray-400">Share your first feedback above!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
