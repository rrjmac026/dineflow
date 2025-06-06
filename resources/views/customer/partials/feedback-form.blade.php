<form method="POST" action="{{ route('customer.feedback') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating</label>
        <div class="flex gap-2 mt-2">
            @for ($i = 1; $i <= 5; $i++)
                <label class="cursor-pointer">
                    <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                    <i class="fas fa-star text-2xl peer-checked:text-amber-400 text-gray-300 hover:text-amber-400 transition-colors"></i>
                </label>
            @endfor
        </div>
    </div>

    <div>
        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Feedback</label>
        <textarea id="message" name="message" rows="4" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
    </div>

    <div>
        <button type="submit" 
            class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition-colors">
            Submit Feedback
        </button>
    </div>
</form>
