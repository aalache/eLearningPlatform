<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <div class="user-hero min-h-[100vh]">
        <div class="backdrop-blur-xl bg-[#efefef]/10 min-h-[100vh]">
            <section class="max-w-7xl mx-auto py-10  ">
                <div class="  space-y-5">
                    <div class="  flex justify-between items-center bg-[#efefef] p-10 rounded-lg">
                        <div class="space-y-2">
                            <h1 class="font-semibold text-4xl">Discover Nice Articles Here</h1>
                            <p class=" capitalize max-w-[500px] text-gray-600">
                                Welcome to our blog, where we share insights, tips, and updates on topics that inspire
                                and inform.Explore our latest posts and stay connected with what matters most.
                            </p>
                        </div>

                        <form action="">
                            @csrf
                            <input type="text" name="query"
                                class="p-3 outline-none border-none text-gray-600 bg-white rounded-full shadow-sm w-[400px]"
                                placeholder="Search...">
                        </form>
                    </div>

                    <div class="bg-[#efefef] p-10 rounded-lg space-y-5">
                        <h2 class="font-semibold text-2xl "> Articles</h2>

                        <div class="">
                            @foreach ($blogs as $blog)
                                {{-- item start --}}
                                <div class=" w-80 overflow-hidden rounded-md  ">
                                    <img src="{{ asset('upload/blogs') }}/{{ $blog->image }}"
                                        class="rounded-md h-64 w-full object-cover" alt="">
                                    <div class="p-3 border-b-2 border-gray-400/50 space-y-2">
                                        <h3 class=" capitalize text-lg font-semibold">
                                            {{ $blog->title }}
                                        </h3>
                                        <p class="text-sm  leading-6">
                                            {!! Str::limit($blog->content, 200, '...') !!}
                                        </p>
                                    </div>
                                    <div class="p-3 space-y-3">
                                        <div class="flex justify-between items-center">
                                            <div class="text-gray-600 text-sm"><i
                                                    class="fa-solid fa-calendar pr-1"></i>{{ $blog->updated_at->format('d/m/Y') }}
                                            </div>
                                            {{-- <div class="text-gray-600 text-sm"><i class="fa-solid fa-eye pr-1"></i>10k
                                                views
                                            </div> --}}
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}"
                                                class=" border-2 border-gray-400/50 w-full p-2 text-center rounded-full   hover:bg-blue-600 hover:text-white">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        {{-- item end --}}
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
