<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--  --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    {{--  --}}
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>


    <main class="bg-white">
        <header class=" bg-opacity-30  ">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <div class="flex-shrink-0">
                        <a href="#" title="" class="flex w-auto h-8 text-black text-xl font-bold">
                            <x-application-logo />
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
                                class="text-sm text-black transition-all duration-200 hover:text-orange-600 font-medium">
                                Home
                            </a>

                            <a href="{{ route('blogs.index') }}" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-orange-600 font-medium">
                                Blogs
                            </a>

                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-orange-600 font-medium">
                                Features
                            </a>

                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-orange-600 font-medium">
                                Solutions
                            </a>

                            <a href="#" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-orange-600 font-medium">
                                Resources
                            </a>

                            <a href="#pricing" title=""
                                class="text-sm text-black transition-all duration-200 hover:text-orange-600 font-medium">
                                Pricing
                            </a>

                        </div>
                        <div>

                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->hasRole('student') && Auth::user()->hasRole('instructor'))
                                        <a href="{{ route('coach.dashboard') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                            Dashboard
                                        </a>
                                    @else
                                        @if (Auth::user()->hasRole('instructor'))
                                            <a href="{{ route('coach.dashboard') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                                Dashboard
                                            </a>
                                        @endif
                                        @if (Auth::user()->hasRole('student'))
                                            <a href="{{ route('user.dashboard') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                                Dashboard
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <div
                                        class="rounded-full bg-[#efefef]  flex justify-center items-center overflow-hidden shadow-sm">
                                        <a href="{{ route('login') }}"
                                            class="rounded-full bg-orange-600 text-white  shadow-md px-3 py-2  ring-1 ring-transparent transition hover:text-gray-300 focus:outline-none  ">
                                            Login
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                                Register
                                            </a>
                                        @endif
                                    </div>
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
                            class="inline-flex w-fit py-2 px-4 items-center lg:mt-8  text-white transition-all duration-200 bg-orange-600 rounded-full  hover:bg-orange-500 "
                            role="button">
                            Get Started
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
    </main>

    {{-- pricing  section --}}
    <section id="pricing" class=" min-h-[100vh] bg-[#111827] ">
        <div class="p-4 sm:p-8 max-w-7xl mx-auto py-20 md:py-32 space-y-14 sm:space-y-24">
            <div class=" text-center space-y-8">
                <div class="space-y-2">
                    <p class="text-lg text-indigo-500 font-medium">Pricing</p>
                    <h2 class=" font-bold text-white text-3xl  sm:text-4xl lg:text-5xl ">Pricing plans for
                        teams of all sizes</h2>
                </div>
                <p class="text-md sm:text-lg text-gray-300 font-medium ">
                    Choose an affordable plan that’s packed with the best features for engaging <br>
                    your audience, creating customer loyalty, and driving sales.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 mx-auto">
                {{-- item --}}
                <div
                    class="col-span-1 mx-w-96 rounded-3xl border hover:border-2 border-gray-700 hover:border-[#6366F1] p-6 sm:p-10 bg-[#111827] hover:bg-[#1D2432] space-y-10  transition ease-linear ">
                    <div class="space-y-4 w-full">
                        <h3 class="text-white font-semibold text-lg">Freelancer</h3>
                        <p class="text-gray-400 text-sm">The essentials to provide your best work for clients.</p>
                        <p class="text-gray-400 font-semibold">
                            <span class="font-bold text-white text-4xl">$15</span>/month
                        </p>
                        <button
                            class="w-full  bg-[#29303D] hover:bg-[#6366F1] p-2 rounded-md text-sm font-semibold text-white transition ease-linear">
                            By Plan
                        </button>
                    </div>

                    <ul class="space-y-3">
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500 "></i><span>5 Products</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Up to 1,000 subscribers</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Basic analytics</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i>
                            <span>48-hour support response time</span>
                        </li>
                    </ul>

                </div>
                {{-- item --}}
                {{-- item --}}
                <div
                    class="col-span-1 mx-w-96 rounded-3xl border hover:border-2 border-gray-700 hover:border-[#6366F1] p-6 sm:p-10 bg-[#111827] hover:bg-[#1D2432] space-y-10  transition ease-linear ">
                    <div class="space-y-4 w-full">
                        <h3 class="text-white font-semibold text-lg">Startup</h3>
                        <p class="text-gray-400 text-sm">A plan that scales with your rapidly growing business.</p>
                        <p class="text-gray-400 font-semibold">
                            <span class="font-bold text-white text-4xl">$30</span>/month
                        </p>
                        <button
                            class="w-full  bg-[#29303D] hover:bg-[#6366F1] p-2 rounded-md text-sm font-semibold text-white transition ease-linear">
                            By Plan
                        </button>
                    </div>

                    <ul class="space-y-3">
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500 "></i><span>25 Products</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Up to 10,000 subscribers</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Advanced analytics</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i>
                            <span>24-hour support response time</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Marketing automations</span>
                        </li>
                    </ul>

                </div>
                {{-- item --}}
                {{-- item --}}
                <div
                    class="col-span-1 mx-w-96 rounded-3xl border hover:border-2 border-gray-700 hover:border-[#6366F1] p-6 sm:p-10 bg-[#111827] hover:bg-[#1D2432] space-y-10  transition ease-linear ">
                    <div class="space-y-4 w-full">
                        <h3 class="text-white font-semibold text-lg">Enterprise</h3>
                        <p class="text-gray-400 text-sm">Dedicated support and infrastructure for your company.</p>
                        <p class="text-gray-400 font-semibold">
                            <span class="font-bold text-white text-4xl">$48</span>/month
                        </p>
                        <button
                            class="w-full  bg-[#29303D] hover:bg-[#6366F1] p-2 rounded-md text-sm font-semibold text-white transition ease-linear">
                            By Plan
                        </button>
                    </div>

                    <ul class="space-y-3">
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500 "></i>
                            <span>Unlimited products </span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Unlimited subscribers</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Advanced analytics</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i>
                            <span>1-hour, dedicated support response time</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Marketing automations</span>
                        </li>
                        <li class="flex justify-start space-x-4 items-center text-sm text-gray-400">
                            <i class="fa-solid fa-check  text-indigo-500"></i><span>Custom reporting tools</span>
                        </li>
                    </ul>

                </div>
                {{-- item --}}

            </div>

        </div>
    </section>
    {{-- pricing end section --}}



    <footer class="py-8 text-center text-sm text-black bg-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>


</body>

</html>
