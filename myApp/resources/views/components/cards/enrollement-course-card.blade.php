@props(['enrollment'])


<div class=" flex rounded-md bg-[#ffffff]/5 backdrop-blur-xl h-[150px]  p-2 space-x-3 overflow-auto">

    <img src="{{ asset('upload/courses') }}/{{ $enrollment->course->image }}" alt=""
        class="min-w-[35%] bg-gray-700 rounded-md h-full object-cover shadow-xl " />

    <div class=" w-full flex flex-col space-y-3 p-3  ">
        <h2 class="text-lg text-[#efefef] font-semibold">
            {{ $enrollment->course->name }}
        </h2>
        <div class="space-y-4">
            <div class="space-y-2">
                <div class="flex justify-between items-center text-orange-600">
                    <p class="text-xs font-bold">Progress</p>
                    <p class="text-xs font-bold">{{ $enrollment->progress }}%</p>
                </div>
                {{-- progress bar --}}
                <div class="w-full bg-gray-200/50 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full text-center text-white"
                        style="width: {{ $enrollment->progress }}%;">
                    </div>
                </div>
                {{--  --}}
            </div>

            @if ($enrollment->status == 'completed')
                <p class="w-fit text-sm font-semibold leading-normal  text-green-600">Completed</p>
            @else
                <a href="{{ route('user.courses.show', $enrollment->course->id) }}"
                    class="w-fit inline-block text-blue-500 text-sm font-semibold leading-normal  hover:underline">
                    Continue Course
                </a>
            @endif
        </div>
    </div>
</div>
