<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 ">


    <div class="bg-white">
        <header class=" bg-opacity-30  ">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <div class="flex-shrink-0">
                        <a href="#" title="" class="flex w-auto h-8 text-black text-xl font-bold">
                            Logo
                        </a>
                    </div>

                    <button type="button"
                        class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16">
                            </path>
                        </svg>

                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <div class="hidden lg:flex lg:items-center lg:justify-between basis-2/3">
                        <div class="lg:space-x-10 lg:flex lg:items-center lg:justify-center">
                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-opacity-80">
                                Features </a>

                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-opacity-80">
                                Solutions </a>

                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-opacity-80">
                                Resources </a>

                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-opacity-80">
                                Pricing </a>
                        </div>
                        <div>

                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->hasRole('student') && Auth::user()->hasRole('instructor'))
                                        <a href="{{ route('coach.dashboard') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                            Dashboard
                                        </a>
                                    @else
                                        @if (Auth::user()->hasRole('instructor'))
                                            <a href="{{ route('coach.dashboard') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                                Dashboard
                                            </a>
                                        @endif
                                        @if (Auth::user()->hasRole('student'))
                                            <a href="{{ route('user.dashboard') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                                Dashboard
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                                            Register
                                        </a>
                                    @endif
                                @endauth

                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </header>

        <section class=" bg-opacity-30 py-10 sm:py-16 lg:py-0 lg:h-[90vh] lg:flex lg:justify-center lg:items-center">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-1 gap-20 lg:gap-12 lg:grid-cols-2">
                    <div class="space-y-8 lg:space-y-16 flex flex-col justify-start  ">
                        <div class="space-y-3">
                            <p class="text-sm font-semibold tracking-wider text-blue-600 uppercase">A
                                New Platform for learners</p>
                            <h1
                                class="mt-4 text-4xl text-bold text-black lg:mt-8 sm:text-[3rem] sm:leading-tight md:text-[3rem]  lg:text-[4rem] lg:leading-none md:max-w-[700px] lg:max-w-[480px] ">
                                Connect <span class=" text-blue-600">&</span> learn from the <span
                                    class=" text-blue-600">experts</span></h1>
                            <p class="mt-4 text-base text-black lg:mt-8 ">Grow your career fast
                                with right mentor.</p>
                        </div>

                        <a href="#" title=""
                            class="inline-flex w-fit py-2 px-3 items-center lg:mt-8  text-white transition-all duration-200 bg-blue-600 rounded-full  hover:bg-blue-500 focus:bg-blue-500"
                            role="button">
                            Join for free
                            <svg class="w-6 h-6 ml-8 -mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>


                    </div>

                    <div>
                        <img class="w-full max-w-[700px]"
                            src="https://cdn.rareblocks.xyz/collection/celebration/images/hero/1/hero-img.png"
                            alt="" />
                    </div>
                </div>
            </div>
        </section>
    </div>



    <footer class="py-8 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>


</body>

</html>
