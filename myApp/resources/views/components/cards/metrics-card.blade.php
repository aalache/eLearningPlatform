@props(['data', 'label', 'delay'])
<div data-aos="zoom-in" data-aos-duration="400" data-aos-delay="{{ $delay }}"
    class="  backdrop-blur-md bg-black/40 col-span-1  border-l-4 shadow-md border-orange-700  rounded-md p-3 space-y-3   ">
    <h2 class="text-white font-semibold text-md md:text-lg  lg:text-xl  leading-normal">{{ $label }}</h2>
    <p class="text-2xl md:text-3xl lg:text-4xl font-semibold text-orange-600">{{ $data }}</p>
</div>
