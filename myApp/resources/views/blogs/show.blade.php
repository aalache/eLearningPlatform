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
    <div class="bg-[#111827] min-h-[100vh]">
        <section class="max-w-7xl mx-auto py-10  ">


            <div class="   p-10 rounded-lg space-y-5">
                <div class="flex justify-start items-center space-x-2">
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
                </div>
                <div class="space-y-5">
                    <h1 class="font-semibold text-4xl text-white">{{ $blog->title }}</h1>
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



</body>

</html>
