@props(['courses' => collect()])



<div class="max-w-7xl mx-auto sm:px-6 lg:px-4 pb-10  min-h-[100vh] ">
    <div class=" overflow-hidden shadow-sm sm:rounded-lg">
        {{-- header --}}
        <div class="py-6 px-6 text-gray-900 space-y-6">


            <div class=" space-y-2">
                <h2 data-aos="fade-right" data-aos-duration="400" data-aos-delay="500"
                    class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold ">
                    All available courses
                </h2>
                <p data-aos="fade-right" data-aos-duration="400" data-aos-delay="600"
                    class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                    Discover, Curate, Enjoy
                </p>
            </div>

            <div class="h-full w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-4 ">
                @if ($courses->isNotEmpty())
                    @php
                        $delay = 1000;
                    @endphp
                    @foreach ($courses as $course)
                        @php
                            $delay += 200;
                        @endphp
                        <x-courseComponents.course-item :delay="$delay" :course="$course" />
                    @endforeach
                @else
                    <div class="rounded-lg col-span-6  bg-orange-600/30 p-3 shadow-sm">

                        <p class="text-lg  text-orange-500   ">
                            No Courses to Show!
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
