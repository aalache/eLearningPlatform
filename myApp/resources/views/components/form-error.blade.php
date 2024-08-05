@props(['name'])

@error($name)
    <p {{ $attributes->merge(['class' => 'text-red-500 text-sm']) }}>{{ $message }}</p>
@enderror
