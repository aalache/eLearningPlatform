@props(['data', 'label'])
<div
    class=" bg-white border-l-4 shadow-md border-blue-600  p-3 space-y-1  text-center  rounded-md  flex flex-col justify-center items-center backdrop-blur-md">
    <h2 class="text-3xl text-blue-600">{{ $data }}</h2>
    <p class="text-gray-600   leading-normal">{{ $label }}</p>
</div>
