<x-page-layout>

    <div class=" flex min-h-full h-full  justify-center items-center  lg:px-8  bg-hero ">
        <div
            class="flex  justify-center items-center h-full sm:h-auto w-full  rounded-none border-none sm:max-w-[400px]  sm:border-2  sm:rounded-xl sm:border-dashed  sm:p-10 sm:block sm:border-indigo-500   backdrop-blur-lg bg-indigo-900/20 ">
            <div class="w-full p-14 sm:p-0">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <a href="/">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    </a>

                    <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">
                        Create new Course
                    </h2>
                </div>

                <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm ">
                    {{-- ? here form start --}}

                    <form action="/courses" method="POST" enctype="multipart/form-data" class="space-y-3">
                        @csrf

                        {{-- Course name field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="name">Name</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="name" name="name"
                                placeholder="course_name" :value="old('name')" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="name" />
                        </x-formComponents.form-field>


                        {{-- Description field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="description">
                                Description</x-formComponents.form-label>
                            <x-formComponents.form-textarea id="description" name="description"
                                placeholder="course_description" :value="old('description')" required />
                            <x-formComponents.form-error name="description" />
                        </x-formComponents.form-field>

                        {{-- duration field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="duration">Duration</x-formComponents.form-label>
                            <x-formComponents.form-input type="number" id="duration" name="duration"
                                placeholder="10 weeks " :value="old('duration')" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="duration" />
                        </x-formComponents.form-field>

                        {{-- level field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="level">Level</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="level" name="level" placeholder="easy"
                                :value="old('level')" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="level" />
                        </x-formComponents.form-field>

                        {{-- Categorie field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="category">Category</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="category" name="category" placeholder="IT"
                                :value="old('category')" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="category" />
                        </x-formComponents.form-field>

                        {{-- price field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="price">Price</x-formComponents.form-label>
                            <x-formComponents.form-input type="number" id="price" name="price" :value="old('price')"
                                placeholder="$99,99" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="price" />
                        </x-formComponents.form-field>

                        {{-- Video file upload field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="image">Thumbnail</x-formComponents.form-label>
                            <x-formComponents.form-input type="file" id="image" name="image" :value="old('image')"
                                required></x-formComponents.form-input>
                            <x-formComponents.form-error name="image" />
                        </x-formComponents.form-field>

                        {{--  upload button --}}
                        <x-formComponents.form-button>Create</x-formComponents.form-button>

                    </form>

                    {{-- ? here form ends --}}

                </div>

            </div>
        </div>
    </div>
</x-page-layout>
