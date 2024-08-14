@props(['activities'])

<div class="py-4 bg-[#ffffff] ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 text-gray-900 space-y-6">
                {{-- welcom heading and summary heading --}}
                <div class="space-y-1">
                    <h2 class="text-2xl">Welcome Back, {{ Auth::user()->name }}</h2>
                </div>
                {{--  --}}

                {{-- summary details --}}
                <div class="space-y-2">
                    <p class="text-[#49779c] text-sm font-normal leading-normal">Here's your learning summary</p>
                    <div class=" flex space-x-3 ">
                        <div
                            class="border-2 bg-[#efefef]/70 shadow-md min-w-[250px] basis-1/4 px-3 py-4  rounded-md text-center space-y-2 backdrop-blur-md">
                            <h2 class="text-3xl">8</h2>
                            <p class="text-gray-600  font-normal leading-normal">Courses completed</p>
                        </div>
                        <div
                            class="border-2 bg-[#efefef]/70 shadow-md min-w-[250px] basis-1/4 px-3 py-4  rounded-md text-center space-y-2 backdrop-blur-md">
                            <h2 class="text-3xl">8</h2>
                            <p class="text-gray-600  font-normal leading-normal">In Progress</p>
                        </div>
                        <div
                            class="border-2 bg-[#efefef]/70 shadow-md min-w-[250px] basis-1/4 px-3 py-4  rounded-md text-center space-y-2 backdrop-blur-md">
                            <h2 class="text-3xl">{{ Auth::user()->courses_enrolledIn()->count() }}</h2>
                            <p class="text-gray-600  font-normal leading-normal">Courses Enrolled In</p>
                        </div>
                        <div
                            class="border-2 bg-[#efefef]/70 shadow-md min-w-[250px] basis-1/4 px-3 py-4  rounded-md text-center space-y-2 backdrop-blur-md">
                            <h2 class="text-3xl">8</h2>
                            <p class="text-gray-600  font-normal leading-normal">Courses completed</p>
                        </div>
                    </div>
                </div>
                {{--  --}}

                {{-- Your courses section --}}

                @if (Auth::user()->enrollements->count())
                    <div class="space-y-2">
                        <div class=" space-y-2">
                            <h2 class="text-lg">Your Courses</h2>
                            <div class=" flex space-x-3">
                                @foreach (Auth::user()->enrollements()->with('course')->take(4)->latest()->get() as $enrollement)
                                    <a href="" class="min-w-[200px] rounded-md basis-1/4  space-y-2">
                                        <img src="{{ asset('upload/courses') }}/{{ $enrollement->course->image }}"
                                            alt="" class="w-full rounded-md">
                                        <div>
                                            <p class="text-gray-600 text-md font-normal leading-relaxed">
                                                {{ $enrollement->course->name }}</p>
                                            <p class="text-[#49779c] text-sm font-normal leading-normal">In Progress</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div>
                                <a href="{{ route('user.enrollement') }}"
                                    class="text-[#234b6b] text-sm font-normal leading-normal">View more</a>
                            </div>
                        </div>
                @endif

                @if ($activities->count())
                    <div class=" space-y-2">
                        <h2 class="text-lg">Your Latest Activity</h2>
                        <div class="  space-y-3">

                            @foreach ($activities as $activity)
                                <div href="" class="w-full rounded-md flex  space-x-3">
                                    <img src="{{ asset('upload/courses') }}/{{ $activity->course->image }}"
                                        alt="" class=" rounded-md max-w-[100px]  basis-1/2">
                                    <div class=" flex justify-between w-full">
                                        <div class="">
                                            <p class="text-gray-600 text-md font-normal leading-relaxed">
                                                {{ $activity->course->name }}</p>
                                            <p class="text-[#49779c] text-sm font-normal leading-normal">
                                                started {{ $activity->updated_at->format('m/d/Y') }}</p>
                                        </div>
                                        <x-courseComponents.course-link
                                            href="{{ route('courses.show', ['course' => $activity->course->id]) }}">Continue</x-courseComponents.course-link>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
