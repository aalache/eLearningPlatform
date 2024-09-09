<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    {{--  --}}
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--  --}}

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<style>
    .user-hero {
        background-image: url({{ asset('images/library.jpeg') }});
        background-size: cover;
        background-position: center;
        font-family: 'inter';
        width: 100%;
    }
</style>

<body>
    <div class="bg-[#111827] w-full min-h-[100vh]">
        <section class="w-full max-w-7xl mx-auto py-10  ">
            <div class="  lg:space-y-5">
                <div
                    class="  flex flex-col lg:flex-row space-y-5 lg:space-y-0 justify-between lg:items-center bg-[#1D2432] p-10  rounded-lg">
                    <div class="space-y-2 ">
                        <h1 class="text-white font-semibold text-4xl">Discover Nice Articles Here</h1>
                        <p class=" capitalize max-w-[500px] text-gray-400">
                            Welcome to our blog, where we share insights, tips, and updates on topics that inspire
                            and inform.Explore our latest posts and stay connected with what matters most.
                        </p>
                    </div>

                    <form action="{{ route('blogs.search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="query" id="query"
                            class="p-3 outline-none border-none text-gray-600 bg-gray-100 rounded-full shadow-sm w-[400px]"
                            placeholder="Search...">
                    </form>
                </div>

                <div class=" p-10 rounded-lg space-y-5 h-auto w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-2xl text-white border-l-4 px-2 border-indigo-700 "> Articles</h2>
                        @if (Auth::user()->hasRole('instructor'))
                            <a href="{{ route('blogs.create') }}"
                                class="rounded-md px-3 py-2 text-white bg-indigo-700 hover:bg-indigo-600">Create
                                Article</a>
                        @endif
                    </div>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                        @foreach ($blogs as $blog)
                            {{-- item start --}}
                            <div
                                class="col-span-1  overflow-hidden rounded-md bg-[#111827] hover:bg-[#1D2432] hover:shadow-lg  hover:scale-105  transition-all ease-in ">

                                <img src="{{ asset('upload/blogs') }}/{{ $blog->image }}"
                                    class="rounded-md h-64 w-full object-cover shadow-lg" alt="">


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
                            {{-- item end --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>

</html>
