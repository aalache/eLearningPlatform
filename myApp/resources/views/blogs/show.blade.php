<x-page>
    <div class="bg-[#111827] min-h-[100vh]">
        <section class="max-w-7xl mx-auto py-10  ">


            <div class="   p-10 rounded-lg space-y-5">
                <div class="flex justify-start items-center space-x-2">
                    @auth
                        @if (Auth::user()->hasRole('instructor'))
                            <a href="{{ route('blogs.edit', ['slug' => $blog->slug]) }}"
                                class="rounded-md px-3 py-2 text-white bg-indigo-700 hover:bg-indigo-600">Edit Article</a>
                            <form action="{{ route('blogs.destroy', ['slug' => $blog->slug]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-md px-3 py-2 text-white bg-red-700 hover:bg-red-600">
                                    Delete Article
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
                <div class="space-y-5">
                    <h1 class="font-semibold text-4xl text-white border-l-4 border-indigo-700 px-2">{{ $blog->title }}
                    </h1>
                    <p class="text-gray-400">By: {{ $blog->user->name }}</p>
                    <div class="w-full  overflow-hidden rounded-md shadow-lg">
                        <img src="{{ asset('upload/blogs') }}/{{ $blog->image }}" alt=""
                            class="rounded-md h-80 w-full object-cover">
                    </div>
                </div>


                <div class="text-gray-300 w-full">
                    {!! $blog->content !!}
                </div>

            </div>

        </section>

    </div>


</x-page>
