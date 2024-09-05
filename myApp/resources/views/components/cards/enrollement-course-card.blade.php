@props(['enrollment'])


<div
    class=" flex flex-col sm:flex-row justify-between sm:items-center rounded-md bg-[#ffffff]/5 backdrop-blur-xl  sm:space-x-3 ">

    <img src="{{ asset('upload/courses') }}/{{ $enrollment->course->image }}" alt=""
        class="w-full md:w-[35%] h-32 lg:h-full bg-gray-700 rounded-md  object-cover shadow-xl " />

    <div class=" w-full flex flex-col space-y-1 sm:space-y-2 p-3  ">
        <h2 class="text-sm md:text-lg text-[#efefef] font-semibold">
            {{ $enrollment->course->name }}
        </h2>
        <div class="space-y-4">
            <div class="space-y-2">
                <div class="flex justify-between items-center text-orange-600">
                    <p class="text-xs font-bold">Progress</p>
                    <p class="text-xs font-bold">{{ $enrollment->progress }}%</p>
                </div>
                {{-- progress bar --}}
                <div class="w-full bg-gray-200/50 rounded-full h-1">
                    <div class="bg-green-600 h-1  rounded-full text-center text-white"
                        style="width: {{ $enrollment->progress }}%;">
                    </div>
                </div>
                {{--  --}}
            </div>

            @if ($enrollment->status == 'completed')
                <p class="w-fit text-xs lg:text-sm font-semibold leading-normal  text-green-600">Completed</p>
            @else
                <a href="{{ route('user.courses.show', $enrollment->course->id) }}"
                    class="w-fit inline-block text-blue-500 text-xs lg:text-sm font-semibold leading-normal  hover:underline">
                    Continue Course
                </a>
            @endif
        </div>
    </div>
</div>
