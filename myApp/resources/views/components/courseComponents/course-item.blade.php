@props(['course'])

@php

    $route = null;
    if (request()->routeIs('user.courses.*')) {
        $route = 'user.courses.show';
    } elseif (request()->routeIs('coach.courses.*')) {
        $route = 'coach.courses.show';
    }
@endphp

<div class="relative  h-[250px]  rounded-t-md hover:rounded-md shadow-md overflow-hidden">
    <a href="{{ route($route, ['course' => $course]) }}">
        {{-- course image --}}
        <img src="{{ asset('upload') }}/courses/{{ $course->image }}" alt="" class="h-[100%] w-full  object-cover">

        {{-- course detail --}}
        <div
            class="group rounded-md w-full h-full absolute  p-3  hover:p-3 translate-y-[-45%]  hover:translate-y-[-100%]   bg-black/70 backdrop-blur-lg   overflow-hidden transition-all ease-linear ">


            <div class="flex justify-start items-center space-x-2 mb-2">
                <div class="h-10 w-10 rounded-full bg-gray-500/40 shadow-md overflow-hidden">
                    <img src="{{ asset('upload/profiles') }}/{{ $course->user->profile_picture }}" alt=""
                        class="w-full h-full object-cover ">
                </div>
                <p class="text-sm text-gray-300"><span class="text-orange-600">@</span>{{ $course->user->name }}</p>
            </div>

            <div class="space-y-3">
                <div>
                    <p class="text-xs text-orange-600 font-semibold">Posted {{ $course->updated_at->diffForHumans() }}
                    </p>
                    <h3 class="font-semibold text-[#efefef] text-md  leading-relaxed">{{ $course->name }}</h3>
                </div>

                <div class="text-sm text-gray-300 w-full space-y-1 ">
                    <p>Level: <span class="font-semibold">{{ $course->level }}</span></p>
                    <p>Duration: <span class="font-semibold">{{ $course->duration }} weeks</span></p>
                    <p>Price: <span class="text-orange-600 font-semibold">$ {{ $course->price }}</span></p>

                </div>
                <div class="">
                    <p class="font-semibold text-sm text-orange-600">
                        #{{ $course->category }}
                    </p>
                </div>
            </div>

        </div>


    </a>
</div>
