{{-- <label for="title"{{ $attributes->merge(['class' => 'block text-sm font-medium leading-6 text-gray-900']) }}>
    {{ $slot }}
</label> --}}

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold leading-6 text-gray-800']) }}>
    {{ $slot }}
</label>
