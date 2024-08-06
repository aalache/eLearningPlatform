<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#111827]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
    <div class=" flex min-h-full h-full  justify-center items-center  lg:px-8  bg-hero ">
        <div
            class="flex  justify-center items-center h-auto w-full  rounded-none border-none sm:max-w-[400px]  sm:border-2  sm:rounded-xl sm:border-dashed  sm:p-10 sm:block sm:border-indigo-500   backdrop-blur-lg bg-indigo-900/20 ">
            <div class="w-full p-14 sm:p-0">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <a href="/">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    </a>
                    @if (request()->is('register'))
                        <h2 class="mt-3 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">Create
                            your
                            account</h2>
                    @endif
                    @if (request()->is('login'))
                        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">Sign in
                            to
                            your account</h2>
                    @endif
                </div>

                <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm ">
                    {{-- ? here form start --}}

                    {{ $slot }}
                    {{-- ? here form ends --}}

                </div>

            </div>
        </div>
    </div>
</body>

</html>
