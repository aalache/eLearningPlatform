<x-page>
    <div class="bg-[#111827] w-full min-h-[100vh]">
        <section class="w-full max-w-7xl mx-auto py-10  ">
            <div class="  lg:space-y-5">
                <div
                    class="  flex flex-col lg:flex-row space-y-5 lg:space-y-0 justify-between lg:items-center bg-[#1D2432] p-10  rounded-lg">
                    <div class="space-y-2 ">
                        <h1 class="text-white font-semibold text-4xl" data-aos="fade-right" data-aos-duration="500"
                            data-aos-delay="300">
                            Discover Nice Articles Here
                        </h1>
                        <p class=" capitalize max-w-[500px] text-gray-400" data-aos="fade-right" data-aos-duration="500"
                            data-aos-delay="600">
                            Welcome to our blog, where we share insights, tips, and updates on topics that inspire
                            and inform.Explore our latest posts and stay connected with what matters most.
                        </p>
                    </div>

                    <form action="{{ route('blogs.search') }}" method="POST" enctype="multipart/form-data"
                        data-aos="fade-left" data-aos-duration="500" data-aos-delay="800">
                        @csrf
                        <input type="text" name="query" id="query"
                            class="p-3 outline-none border-none text-gray-600 bg-gray-100 rounded-full shadow-sm w-[400px]"
                            placeholder="Search...">
                    </form>
                </div>

                <div class=" p-10 rounded-lg space-y-5 h-auto w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-2xl text-white border-l-4 px-2 border-indigo-700 "
                            data-aos="fade-right" data-aos-duration="500" data-aos-delay="1000">
                            Articles
                        </h2>
                        @auth
                            @if (Auth::user()->hasRole('instructor'))
                                <a href="{{ route('blogs.create') }}" data-aos="fade-left" data-aos-duration="500"
                                    data-aos-delay="1000"
                                    class="rounded-md px-3 py-2 text-white bg-indigo-700 hover:bg-indigo-600">Create
                                    Article</a>
                            @endif
                        @endauth
                    </div>
                    <div class=" grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $delay = 1000;
                        @endphp
                        @foreach ($blogs as $blog)
                            <x-cards.blog-card :blog="$blog" :delay="$delay" />
                            @php
                                $delay += 200;
                            @endphp
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

    </div>

</x-page>
