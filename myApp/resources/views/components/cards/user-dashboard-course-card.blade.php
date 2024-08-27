@props(['enrollement'])

<a {{ $attributes->merge(['class' => 'min-w-[150px] max-w-[250px] rounded-md bg-[#efefef]  basis-1/4  space-y-2']) }}>
    <img src="{{ asset('upload/courses') }}/{{ $enrollement->course->image }}" alt=""
        class="w-full rounded-t-md max-">
    <div class="p-3">
        <p class="text-gray-600 text-md font-normal leading-relaxed">
            {{ $enrollement->course->name }}</p>
        <p class="text-[#49779c] text-sm font-normal leading-normal">In Progress
        </p>
    </div>
</a>
