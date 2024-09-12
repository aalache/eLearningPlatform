<nav {{ $attributes->merge(['class' => '  ']) }}>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <div class="flex-shrink-0" data-aos="fade-right">
                <a href="#" title="" class="flex w-auto h-8 text-black text-xl font-bold">
                    <x-application-logo />
                </a>
            </div>

            <button type="button" data-aos="fade-left"
                class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">
                <!-- Menu open: "hidden", Menu closed: "block" -->
                <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16">
                    </path>
                </svg>

                <!-- Menu open: "block", Menu closed: "hidden" -->
                <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="hidden lg:flex lg:items-center lg:justify-between basis-2/3">
                <div data-aos="fade-in" data-aos-delay="400"
                    class="lg:space-x-10 lg:flex lg:items-center lg:justify-center">
                    <a href="{{ route('home') }}" data-aos="zoom-in" data-aos-delay="100"
                        class="text-sm text-black transition-all duration-200 hover:text-orange-600 ">
                        Home
                    </a>

                    <a href="{{ route('blogs.index') }}" data-aos="zoom-in" data-aos-delay="200"
                        class="text-sm text-black transition-all duration-200 hover:text-orange-600 ">
                        Blogs
                    </a>

                    <a href="#" data-aos="zoom-in" data-aos-delay="300"
                        class="text-sm text-black transition-all duration-200 hover:text-orange-600 ">
                        Features
                    </a>

                    <a href="#" data-aos="zoom-in" data-aos-delay="400"
                        class="text-sm text-black transition-all duration-200 hover:text-orange-600 ">
                        Solutions
                    </a>

                    <a href="#" data-aos="zoom-in" data-aos-delay="500"
                        class="text-sm text-black transition-all duration-200 hover:text-orange-600 ">
                        Resources
                    </a>

                    <a href="#pricing" data-aos="zoom-in" data-aos-delay="600"
                        class="text-sm text-black transition-all duration-200 hover:text-orange-600 ">
                        Pricing
                    </a>
                </div>

                <div>

                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->hasRole('student') && Auth::user()->hasRole('instructor'))
                                <a href="{{ route('coach.dashboard') }}" data-aos="fade-left"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                    Dashboard
                                </a>
                            @else
                                @if (Auth::user()->hasRole('instructor'))
                                    <a href="{{ route('coach.dashboard') }}" data-aos="fade-left"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                        Dashboard
                                    </a>
                                @endif
                                @if (Auth::user()->hasRole('student'))
                                    <a href="{{ route('user.dashboard') }}" data-aos="fade-left"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  ">
                                        Dashboard
                                    </a>
                                @endif
                            @endif
                        @else
                            <div data-aos="fade-left"
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
</nav>
