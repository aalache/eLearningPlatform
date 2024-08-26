@props(['course'])

@php

    $route = null;
    if (request()->routeIs('user.courses.*')) {
        $route = 'user.courses.show';
    } elseif (request()->routeIs('coach.courses.*')) {
        $route = 'coach.courses.show';
    }
@endphp

<div class="relative  h-[340px] bg-[#ffffff]  rounded-md shadow-md overflow-hidden">
    <a href="{{ route($route, ['course' => $course]) }}">
        {{-- course image --}}
        <img src="{{ asset('upload') }}/courses/{{ $course->image }}" alt=""
            class="h-[55%] w-full rounded-t-md object-cover">

        {{-- course detail --}}
        <div
            class="w-full h-full absolute bg-[#ffffff] rounded-b-md px-3 py-1 hover:p-3 hover:translate-y-[-55%]  hover:rounded-md hover:bg-[#efefef] transition-all ease-in space-y-1 overflow-hidden ">


            <div class="flex justify-start items-center space-x-2 mb-2">
                <div class="h-10 w-10 rounded-full bg-gray-500/40 border-2"></div>
                <p class="text-sm text-black"><span class="text-indigo-800">@</span>{{ $course->user->name }}</p>
            </div>



            <p class="text-xs text-gray-600">Posted {{ $course->updated_at->diffForHumans() }}</p>
            <h3 class="">{{ $course->name }}</h3>

            <div class="text-sm text-gray-600 w-full space-y-1 ">
                <p>Level: {{ $course->level }}</p>
                <p>Duration: {{ $course->duration }} weeks</p>
                <p>Price: $ {{ $course->price }}</p>

                <div class="mt-2">
                    <p class="p-2 rounded-md bg-teal-500/30 w-fit text-gray-600">#{{ $course->category }}</p>
                </div>
            </div>

        </div>


    </a>
</div>
