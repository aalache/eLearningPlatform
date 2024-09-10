<x-page>
    <div class="bg-[#111827] min-h-[100vh]">
        <section class="max-w-7xl mx-auto py-10  ">


            <div class="  bg-[#1D2432]  p-10 rounded-lg space-y-5">
                <div class="space-y-2">
                    <h1 class="font-semibold text-4xl text-white">Add New Article Here</h1>
                    <p class=" capitalize max-w-[500px]  text-gray-400">
                        Unleash your creativity and bring your ideas to life. Start crafting your blog post and
                        share your unique voice with the world!
                    </p>
                </div>

                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <x-formComponents.form-field class="flex flex-col justify-center  space-y-2">
                        <label for="title" class="text-gray-300 font-semibold">Title</label>
                        <input type="text" name="title" id="title" :value="old("title")"
                            class="p-3 outline-none border-none text-indigo-700 font-semibold bg-white rounded-md shadow-sm w-[400px]"
                            placeholder="Title">
                        <x-formComponents.form-error name="title" />
                    </x-formComponents.form-field>

                    <x-formComponents.form-field class="flex flex-col justify-center  space-y-2">
                        <label for="image" class="text-gray-300 font-semibold">Image</label>
                        <input type="file" name="image" id="image"
                            class="p-3 outline-none border-none text-gray-600 bg-white rounded-md shadow-sm w-[400px]">
                        <x-formComponents.form-error name="image" />
                    </x-formComponents.form-field>

                    <x-formComponents.form-field class="flex flex-col justify-center  space-y-2">
                        <label for="content" class="text-gray-300 font-semibold">Content</label>
                        <textarea name="content" id="content" :value="old('content')" class="form-control "></textarea>
                        <x-formComponents.form-error name="content" />
                    </x-formComponents.form-field>

                    <button type="submit"
                        class="w-fit px-3 py-2  bg-indigo-700 rounded-md text-white hover:bg-indigo-600">
                        Create Article
                    </button>

                </form>
            </div>


        </section>
    </div>





</x-page>
