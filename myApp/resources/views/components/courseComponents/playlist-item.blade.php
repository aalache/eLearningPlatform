@props(['videoTitle', 'playlist', 'video'])
@php
    $isCurrentRoute = url()->current() == route('coach.viewplaylist', ['playlist' => $playlist, 'video' => $video]);
@endphp
<a {{ $attributes->merge(['class' => '']) }}>
    <li
        class="group transition-all ease-in border-r-2 hover:border-blue-600 {{ $isCurrentRoute ? 'border-blue-600' : 'none' }}">
        <div class="flex space-x-3 w-full items-center">
            <div class="flex flex-col items-center gap-1">
                <div
                    class="w-[2px]  h-4 group-hover:bg-blue-600 transition-all ease-in {{ $isCurrentRoute ? 'bg-blue-600' : 'bg-gray-600 ' }}   ">
                </div>
                <div
                    class="size-1.5 rounded-full  group-hover:bg-blue-600 transition-all ease-in {{ $isCurrentRoute ? 'bg-blue-600' : 'bg-gray-600 ' }} ">
                </div>
                <div
                    class="w-[2px] h-4 grow group-hover:bg-blue-600 transition-all ease-in {{ $isCurrentRoute ? 'bg-blue-600' : 'bg-gray-600 ' }} ">
                </div>
            </div>
            <p
                class=" group-hover:text-blue-600  {{ $isCurrentRoute ? 'text-blue-600' : 'text-gray-600 ' }} transition-all ease-in">
                {{ $videoTitle }}</p>
        </div>
    </li>
</a>
