@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} required {!! $attributes->merge([
    'class' =>
        'p-2 bg-white/15  rounded-md shadow-sm text-gray-300 font-medium focus:ring-2 focus:ring-inset focus:ring-orange-600 outline-none  focus-visible:outline-dashed focus-visible:outline-offset-4 focus-visible:outline-orange-600',
]) !!}>
