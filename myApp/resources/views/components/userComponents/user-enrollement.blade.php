@props(['enrollments'])

<div class="">
    <div class="max-w-7xl mx-auto px-3 sm:px-6  lg:px-4 py-10 h-full min-h-[100vh]">
        <div class=" overflow-hidden  sm:rounded-lg min-h-full  ">
            <div class="py-6 text-gray-900 space-y-10">

                <div class=" space-y-2">
                    <h2 data-aos="fade-right" data-aos-duration="400" data-aos-delay="500"
                        class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold ">
                        My Enrollements
                    </h2>
                    <p data-aos="fade-right" data-aos-duration="400" data-aos-delay="600"
                        class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                        Unlock Your Potential with Every Click
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    @if ($enrollments->isNotEmpty())
                        @php
                            $delay = 700;
                        @endphp
                        @foreach ($enrollments as $enrollment)
                            @php
                                $delay += 200;
                            @endphp
                            <x-cards.enrollement-course-card :delay="$delay" :enrollment="$enrollment" />
                        @endforeach
                    @else
                        <div class="rounded-lg col-span-6  bg-orange-600/30 p-3 shadow-sm">

                            <p class="text-lg  text-orange-500   ">
                                Your Learning Path is Waiting!
                            </p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
