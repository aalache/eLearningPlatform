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


            <div class="  bg-[#1D2432]  p-10 rounded-lg space-y-5">
                <div class="space-y-2">
                    <h1 class="font-semibold text-4xl text-white">Add New Article Here</h1>
                    <p class=" capitalize max-w-[500px]  text-gray-400">
                        Unleash your creativity and bring your ideas to life. Start crafting your blog post and
                        share your unique voice with the world!
                    </p>
                </div>

                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <x-formComponents.form-field class="flex flex-col justify-center  space-y-2">
                        <label for="title" class="text-gray-300 font-semibold">Title</label>
                        <input type="text" name="title" id="title" :value="old("title")"
                            class="p-3 outline-none border-none text-gray-600 bg-white rounded-md shadow-sm w-[400px]"
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



    <script src="https://cdn.tiny.cloud/1/2xc6ons7tiuippim3wwx0jhdxypx7nwrcgrnqp2h4e0wrm5j/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
                'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Sep 21, 2024:
                'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
                'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
                'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
                'autocorrect', 'typography', 'inlinecss', 'markdown',
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                'See docs to implement AI Assistant')),
        });
    </script>

</body>

</html>
