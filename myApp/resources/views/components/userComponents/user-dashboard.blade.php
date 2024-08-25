@php
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\CourseController;
@endphp

@props(['activities'])

<div class="py-4 bg-[#ffffff] ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 text-gray-900 space-y-8">
                {{-- welcom heading and summary heading --}}
                <div class="space-y-1">
                    <h2 class="text-2xl border-l-4 border-blue-600 px-2">Welcome Back, {{ Auth::user()->name }}</h2>
                </div>
                {{--  --}}

                {{-- summary details --}}
                <div class="space-y-2">
                    <p class="text-[#49779c] text-sm font-normal leading-normal">Here's your learning summary
                        @php

                            $enrollements = auth()->user()->enrollements()->with('course')->get();
                            foreach ($enrollements as $enrollement) {
                                CourseController::progress($enrollement->course);
                            }

                        @endphp

                    </p>
                    <div class="  space-x-3 grid grid-cols-3 gap-2">
                        <div
                            class=" bg-[#efefef]/70 border-l-4 shadow-md border-blue-600  p-3 space-y-1  text-center  rounded-md  flex flex-col justify-center items-center backdrop-blur-md">
                            <h2 class="text-3xl text-blue-600">{{ StudentController::enrollements() }}</h2>
                            <p class="text-gray-600   leading-normal">Courses Enrolled In</p>
                        </div>
                        <div
                            class=" bg-[#efefef]/70 border-l-4 shadow-md border-blue-600  p-3 space-y-1  text-center  rounded-md  flex flex-col justify-center items-center backdrop-blur-md">
                            <h2 class="text-3xl text-blue-600">{{ StudentController::inProgress() }}</h2>
                            <p class="text-gray-600   leading-normal">In Progres</p>
                        </div>
                        <div
                            class=" bg-[#efefef]/70 border-l-4 shadow-md border-blue-600  p-3 space-y-1  text-center  rounded-md  flex flex-col justify-center items-center backdrop-blur-md">
                            <h2 class="text-3xl text-blue-600">{{ StudentController::completed() }}</h2>
                            <p class="text-gray-600   leading-normal">Courses completed</p>
                        </div>

                    </div>
                </div>
                {{--  --}}

                {{-- Your courses section --}}

                @if (Auth::user()->enrollements->count())
                    <div class="space-y-2">
                        <div class=" space-y-5">
                            <h2 class="text-xl text-black border-l-4 border-blue-600 px-2">Your Course</h2>
                            <div class=" space-y-2">
                                <div class="flex space-x-3">
                                    @foreach (Auth::user()->enrollements()->where('status', 'in_progress')->with('course')->take(4)->latest()->get() as $enrollement)
                                        <a href="{{ route('courses.show', ['course' => $enrollement->course]) }}"
                                            class="min-w-[150px] max-w-[250px] rounded-md bg-[#efefef]  basis-1/4  space-y-2">
                                            <img src="{{ asset('upload/courses') }}/{{ $enrollement->course->image }}"
                                                alt="" class="w-full rounded-t-md max-">
                                            <div class="p-3">
                                                <p class="text-gray-600 text-md font-normal leading-relaxed">
                                                    {{ $enrollement->course->name }}</p>
                                                <p class="text-[#49779c] text-sm font-normal leading-normal">In Progress
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div>
                                    <a href="{{ route('user.enrollement') }}"
                                        class="text-[#234b6b] text-sm font-normal leading-normal">View more</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif


                @if (Auth::user()->activities->count())
                    <div class="space-y-2">
                        <div class=" space-y-5">
                            <h2 class="text-xl text-black border-l-4 border-blue-600 px-2">Your Reccent activities</h2>
                            <div class="space-y-2">
                                @foreach (Auth::user()->activities()->take(6)->latest()->get() as $activity)
                                    @if (strpos($activity->activity_type, 'Enrolled') ||
                                            strpos($activity->activity_type, 'Completed') ||
                                            strpos($activity->activity_type, 'Uploaded'))
                                        <div
                                            class=" flex  justify-between items-center space-y-1 w-full bg-green-100 shadow-sm p-3 rounded-md">
                                            <div class=" ">
                                                <h3 class=" text-green-700">{{ $activity->activity_type }}</h3>
                                                <p class="text-sm text-gray-700">{{ $activity->description }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-green-600">
                                                    {{ $activity->created_at->format('M d, Y | h:i a') }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class=" flex  justify-between items-center space-y-1 w-full bg-red-100 shadow-sm p-3 rounded-md">
                                            <div class=" ">
                                                <h3 class=" text-red-700">{{ $activity->activity_type }}</h3>
                                                <p class="text-sm text-gray-700">{{ $activity->description }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-red-600">
                                                    {{ $activity->created_at->format('M d, Y | h:i a') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                @endif

                {{-- @if ($activities->count())
                    <div class=" space-y-5">
                        <h2 class="text-xl text-black border-l-4 border-blue-600 px-2">Your Latest Activity</h2>
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
                @endif --}}

            </div>
        </div>
    </div>
