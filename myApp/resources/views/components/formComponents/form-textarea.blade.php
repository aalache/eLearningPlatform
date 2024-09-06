<div class="mt-2">
    <textarea
        {{ $attributes->merge(['class' => 'block w-full rounded-md border-0  text-orange-700 font-medium shadow-sm  placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6  px-3 py-2.5 focus-visible:outline-dashed focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400 backdrop-blur-sm bg-white"']) }}>{{ $slot }}</textarea>
</div>
