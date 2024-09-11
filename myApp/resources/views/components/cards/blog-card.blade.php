@props(['blog', 'delay'])

<div data-aos="zoom-in" data-aos-duration="500" data-aos-delay="{{ $delay }}"
    class="  h-[460px]  rounded-md bg-[#111827] hover:bg-[#1D2432] hover:shadow-lg  hover:scale-105  transition-all ease-in ">

    {{-- blog image --}}
    <img src="{{ asset('upload/blogs') }}/{{ $blog->image }}" class="rounded-md h-52 w-full object-cover shadow-lg"
        alt="">

    {{-- blog detail --}}
    <div class=" ">

        <div class="p-3  space-y-2 h-36 overflow-hidden">
            <h3 class="text-white capitalize text-lg font-semibold">
                {{ $blog->title }}
            </h3>

            <div class="text-gray-300 text-sm font-medium">
                {!! Str::limit($blog->content, 80, '...') !!}
            </div>
        </div>

        <div class="p-3 space-y-3 border-t-2 border-[#6366F1]">
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center text-gray-400 text-sm">
                    <i class="fa-solid fa-calendar pr-1 text-indigo-500"></i>
                    <p>{{ $blog->updated_at->format('d/m/Y') }}</p>
                </div>
                <div class="flex justify-start items-center text-gray-400 text-sm">
                    <i class="fa-solid fa-eye pr-1 text-indigo-500"></i>
                    <p>10k views</p>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}"
                    class=" border-2 border-[#6366F1] w-full p-2 text-center rounded-full   hover:bg-indigo-600 text-gray-300 hover:text-white">
                    Read More
                </a>
            </div>
        </div>

    </div>


</div>
