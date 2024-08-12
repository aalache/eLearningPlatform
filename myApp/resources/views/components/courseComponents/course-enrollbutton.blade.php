<button
    {{ $attributes->merge(['class' => 'min-w-[120px] font-semibold flex overflow-hidden items-center text-sm font-medium focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-black text-white shadow hover:bg-black/90 h-9 px-4 py-2 w-fit whitespace-pre md:flex group relative  justify-center gap-2 rounded-md transition-all duration-300 ease-out hover:ring-2 hover:ring-black hover:ring-offset-2']) }}
    href="#">
    <span
        class="absolute right-0 -mt-12 h-32 w-8 translate-x-12 rotate-12 bg-white opacity-10 transition-all duration-1000 ease-out group-hover:-translate-x-40">ff</span>
    <div class="flex items-center">
        <span class="ml-1 text-white">{{ $slot }}</span>
    </div>
</button>
