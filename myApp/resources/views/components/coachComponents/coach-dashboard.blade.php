@php
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\CoachController;
@endphp

@props(['activities'])

<div class="py-4 bg-[#ffffff] ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
        <div class="bg-white overflow-hidden  sm:rounded-lg">
            <div class="p-2 text-gray-900 space-y-6">
                {{-- welcom heading and summary heading --}}
                <div class="space-y-1">
                    <h2 class="text-2xl border-l-4 border-blue-600 px-2">Welcome Back, {{ Auth::user()->name }}</h2>
                </div>
                {{--  --}}

                {{-- summary details --}}
                <div class="space-y-2">
                    <p class="text-[#49779c] text-sm font-normal leading-normal">Here's your workspace metrics
                        @php

                            $enrollements = auth()->user()->enrollements()->with('course')->get();
                            foreach ($enrollements as $enrollement) {
                                CourseController::progress($enrollement->course);
                            }

                        @endphp

                    </p>
                    <div class="  space-x-3 grid grid-cols-5 gap-2">
                        <x-cards.metrics-card :data="CoachController::metrics('total_videos')" :label="'Videos'" />
                        <x-cards.metrics-card :data="CoachController::metrics('total_playlists')" :label="'Playlists'" />
                        <x-cards.metrics-card :data="CoachController::metrics('total_courses')" :label="'Courses'" />
                        <x-cards.metrics-card :data="CoachController::metrics('total_enrollements')" :label="'Enrollements'" />
                        <x-cards.metrics-card :data="CoachController::metrics('total_users')" :label="'Active Users'" />
                    </div>
                </div>
                {{--  --}}

                {{-- Your courses section --}}

                @if (Auth::user()->activities->count())
                    <div class="space-y-2">
                        <div class=" space-y-5">
                            <h2 class="text-xl text-black border-l-4 border-blue-600 px-2">Your Reccent activities</h2>
                            <div class="space-y-2">
                                @foreach (Auth::user()->activities()->take(6)->latest()->get() as $activity)
                                    @if (strpos($activity->activity_type, 'Updated') ||
                                            strpos($activity->activity_type, 'Uploaded') ||
                                            strpos($activity->activity_type, 'Added'))
                                        <div
                                            class=" flex  justify-between items-center space-y-1 w-full bg-blue-100 shadow-sm p-3 rounded-md">
                                            <div class=" ">
                                                <h3 class=" text-blue-700">{{ $activity->activity_type }}</h3>
                                                <p class="text-sm text-gray-700">{{ $activity->description }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-blue-600">
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



            </div>
        </div>
    </div>
