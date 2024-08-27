@php
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\CourseController;
@endphp

@props(['activities'])



<div class=" backdrop-blur-3xl bg-black/80 py-4 ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-2 py-8 text-gray-900 space-y-8">
                {{-- welcom heading and summary heading --}}
                <div class="space-y-1 text-gray-300">
                    <h2 class="text-4xl border-l-4 border-blue-600 px-2">Welcome Back, {{ Auth::user()->name }}</h2>
                </div>
                {{--  --}}

                {{-- summary details --}}
                <div class="space-y-3">
                    <p class="text-blue-600 text-sm font-normal leading-normal">Here's your learning summary</p>
                    @php

                        $enrollements = auth()->user()->enrollements()->with('course')->get();
                        foreach ($enrollements as $enrollement) {
                            CourseController::progress($enrollement->course);
                        }

                    @endphp


                    <div class="  space-x-3 grid grid-cols-3 gap-2">
                        <x-cards.metrics-card :data="StudentController::enrollements()" :label="'Courses Enrolled In'" />
                        <x-cards.metrics-card :data="StudentController::inProgress()" :label="'In Progress'" />
                        <x-cards.metrics-card :data="StudentController::completed()" :label="'Courses completed'" />
                    </div>
                </div>
                {{--  --}}

                {{-- Your courses section --}}

                @if (Auth::user()->enrollements->count())
                    <div class="space-y-2">
                        <div class=" space-y-5">
                            <h2 class="text-2xl text-gray-200 border-l-4 border-blue-600 px-2">Your Course</h2>
                            <div class=" space-y-2">
                                <div class="flex space-x-3">
                                    @foreach (Auth::user()->inProgressCourses()->take(4)->latest()->get() as $enrollement)
                                        <x-cards.user-dashboard-course-card
                                            href="{{ route('user.courses.show', ['course' => $enrollement->course]) }}"
                                            :enrollement="$enrollement" />
                                    @endforeach
                                </div>
                                <div>
                                    <a href="{{ route('user.enrollement.index') }}"
                                        class="text-[#234b6b] text-sm font-normal leading-normal">View more</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif


                @if (Auth::user()->activities->count())
                    <div class="space-y-2">
                        <div class=" space-y-5">
                            <h2 class="text-2xl text-gray-200  border-l-4 border-blue-600 px-2">Your Reccent activities
                            </h2>
                            <div class="space-y-2">
                                @foreach (Auth::user()->activities()->take(6)->latest()->get() as $activity)
                                    <x-cards.activity-card :activity="$activity" />
                                @endforeach
                            </div>
                        </div>
                @endif

            </div>
        </div>
    </div>
