@props(['name'])

<div class="group relative  h-auto p-3 rounded-lg  bg-[#efefef]">
    <img src="{{ asset('images/playlistimage.jpeg') }}" alt=""
        class="w-full  sticky top-0 left-0 z-50 shadow-lg group-hover:shadow-xl transition-all ease-in rounded-md group-hover:translate-y-[-45px] ">
    <div class="bg-[#efefef] w-full  absolute bottom-0 left-0 h-auto py-3 px-4 rounded-b-lg p">
        <h3 class="w-full justify-start items-center text-gray-800 text-md overflow-hidden">{{ $name }}</h3>
    </div>
</div>
