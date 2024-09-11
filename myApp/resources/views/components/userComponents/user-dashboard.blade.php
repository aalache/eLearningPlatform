@php
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\CourseController;
@endphp

@props(['inProgressCourses'])




<div class="max-w-7xl mx-auto sm:px-6 lg:px-6 py-4 min-h-[100vh]">
    <div class=" overflow-hidden shadow-sm sm:rounded-lg">

        <div class="px-2 pt-8 pb-4 text-gray-900 space-y-6">
            {{-- welcom heading and summary heading --}}
            <div class="space-y-1 text-[#efefef]">
                <h2 class="text-4xl font-semibold " data-aos="fade-right" data-aos-duration="400" data-aos-delay="500">
                    Welcome Back<span class="text-orange-600">,
                        {{ Auth::user()->name }}</span></h2>
            </div>
            {{--  --}}
            {{-- summary details --}}
            <div class="space-y-3">
                <p class=" text-[#ffffff]/60 text-sm font-bold leading-normal" data-aos="fade-right"
                    data-aos-duration="400" data-aos-delay="600">
                    Here's your learning summary
                </p>
                @php
                    $enrollements = auth()->user()->enrollements()->with('course')->get();
                    foreach ($enrollements as $enrollement) {
                        CourseController::progress($enrollement->course);
                    }
                @endphp
                <div class="
                    grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <x-cards.metrics-card :data="StudentController::enrollements()" :label="'Courses Enrolled In'" :delay="700" />
                    <x-cards.metrics-card :data="StudentController::inProgress()" :label="'In Progress'" :delay="900" />
                    <x-cards.metrics-card :data="StudentController::completed()" :label="'Courses completed'" :delay="1100" />
                </div>
            </div>
            {{--  --}}
        </div>

        <div class="px-2 py-8 text-gray-900 space-y-4">
            {{-- Your courses section --}}
            @if (Auth::user()->enrollements->count())
                <div class="space-y-2 backdrop-blur-sm  bg-black/40 rounded-2xl" data-aos="zoom-in"
                    data-aos-duration="400" data-aos-delay="1200">
                    <div class=" space-y-5 p-4 rounded-2xl">
                        <h2 data-aos="zoom-in" data-aos-duration="400" data-aos-delay="1300"
                            class="text-xl text-white font-semibold border-l-4 border-orange-600 px-2">
                            Course In Progress
                        </h2>
                        <div class=" space-y-2">
                            <div class="grid grid-cols-4 gap-2">
                                @php
                                    $delay = 1400;
                                @endphp
                                @foreach ($inProgressCourses as $enrollement)
                                    @php
                                        $delay += 200;
                                    @endphp
                                    <x-cards.user-dashboard-course-card :delay="$delay"
                                        href="{{ route('user.courses.show', ['course' => $enrollement->course]) }}"
                                        :enrollement="$enrollement" />
                                @endforeach
                            </div>
                            <div>
                                <a href="{{ route('user.enrollement.index') }}"
                                    class="text-orange-500 text-xs font-semibold leading-normal">View more</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif


            @if (Auth::user()->activities->count())
                <div class="space-y-2 backdrop-blur-3xl bg-black/40 rounded-2xl   ">
                    <div class=" space-y-5 p-4  rounded-2xl">
                        <h2 class="text-xl text-white font-semibold border-l-4 border-orange-600 px-2">Activity
                            History
                        </h2>
                        <div class="space-y-2 overflow-y-auto ">

                            @foreach (Auth::user()->activities()->take(6)->latest()->get() as $activity)
                                <x-cards.activity-card :delay="700" :activity="$activity" />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
