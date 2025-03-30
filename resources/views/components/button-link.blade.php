@props(['href'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 rounded-lg transition-colors duration-200']) }}>
    {{ $slot }}
</a>
