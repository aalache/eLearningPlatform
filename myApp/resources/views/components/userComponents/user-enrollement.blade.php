@props(['enrollments'])

<div class="py-0 bg-white h-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 ">
        <div class="bg-white overflow-hidden  sm:rounded-lg min-h-full  ">
            <div class="p-6 text-gray-900 space-y-3">
                <div class=" space-y-0">
                    <h2 class="border-l-4 px-2 border-blue-600 text-2xl font-meduim ">My Enrollements</h2>
                    <p class="border-l-4 px-2 text-sm border-blue-600 text-blue-600 ">Unlock Your Potential with Every
                        Click</p>
                </div>

                <div class=" space-y-3">
                    @foreach ($enrollments as $enrollment)
                        <div class=" flex rounded-md bg-[#ffffff] h-[150px] p-2 space-x-5">
                            <img src="{{ asset('upload/courses') }}/{{ $enrollment->course->image }}" alt=""
                                class="w-[25%] bg-gray-700 rounded-md h-full object-cover shadow-xl" />
                            <div class=" w-full flex flex-col space-y-3  ">
                                <h2 class="text-xl  text-gray-900">
                                    {{ $enrollment->course->name }}
                                </h2>
                                <div class="space-y-5">
                                    <div class="w-full space-y-2 bg-gray-200 rounded-full h-2 mb-4">
                                        <div class="bg-green-600 h-2 rounded-full text-center text-white"
                                            style="width: {{ $enrollment->progress }}%;">
                                        </div>
                                        <p class="text-sm">{{ $enrollment->progress }}%</p>
                                    </div>
                                    @if ($enrollment->status != 'completed')
                                        <a href="{{ route('courses.show', $enrollment->course->id) }}"
                                            class="w-fit inline-block text-[#49779c]  text-sm  hover:underline">
                                            Continue Course
                                        </a>
                                    @else
                                        <p class="text-sm py-3 text-gray-500">Completed</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="container mx-auto px-4">
                    <div class="w-full space-y-2">
                        @foreach ($enrollments as $enrollment)
                            <div
                                class="bg-[#efefef] shadow-md rounded-lg  w-full h-[150px] flex items-center justify-start space-x-4">

                                <div class=" h-full w-[30%] bg-black">
                                    <img src="{{ asset('upload/courses') }}/{{ $enrollment->course->image }}"
                                        alt="" class=" ">
                                </div>

                                <div class="flex items-center justify-between w-auto bg-red-500">
                                    <div>
                                        <h5 class="text-xl font-semibold mb-2">{{ $enrollment->course->name }}</h5>

                                        <div class="w-full bg-gray-200 rounded-full h-6 mb-4">
                                            <div class="bg-green-600 h-6 rounded-full text-center text-white"
                                                style="width: {{ $enrollment->progress }}%;">
                                                {{ $enrollment->progress }}%
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('courses.show', $enrollment->course->id) }}"
                                        class="inline-block bg-blue-600 text-white py-2 px-4 rounded">
                                        Continue Course
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}




            </div>
        </div>
    </div>
</div>
