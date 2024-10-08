<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#111827]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- scripts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


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

<body class=" h-full user-hero">
    <div class=" flex min-h-full h-full  justify-center items-center  lg:px-8   backdrop-blur-md  ">
        <div
            class="flex  justify-center items-center h-full sm:h-auto  w-full  rounded-none border-none sm:max-w-[400px]  sm:border-2  sm:rounded-xl sm:border-dashed     backdrop-blur-lg bg-[#efefef]/80 shadow-xl ">
            <div class="w-full p-4 sm:p-6 md:p-8 ">
                <div class=" ">
                    {{-- <a href="/">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    </a> --}}
                    @if (request()->is('register'))
                        <h2 class="mt-3 text-center text-2xl font-bold leading-9 tracking-tight text-gray-600"
                            data-aos="zoom-in" data-aos-duration="400" data-aos-delay="100">
                            Create your account</h2>
                    @endif
                    @if (request()->is('login'))
                        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-600"
                            data-aos="zoom-in" data-aos-duration="400" data-aos-delay="300">
                            Sign in to your account</h2>
                    @endif
                </div>

                <div class="mt-5 ">
                    {{-- ? here form start --}}

                    {{ $slot }}
                    {{-- ? here form ends --}}

                </div>

            </div>
        </div>
    </div>

    {{-- animation --}}

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    {{--  --}}
</body>

</html>
