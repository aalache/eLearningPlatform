@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'p-2 bg-white/15  rounded-md shadow-sm text-gray-400 ',
]) !!}>
