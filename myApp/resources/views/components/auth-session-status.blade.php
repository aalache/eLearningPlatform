@props(['status'])

@if ($status)
    <div
        {{ $attributes->merge(['class' => 'font-medium bg-green-500/50 w-full p-3 text-center rounded-md text-sm text-gray-400']) }}>
        {{ $status }}
    </div>
@endif
