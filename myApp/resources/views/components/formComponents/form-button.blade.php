<button
    {{ $attributes->merge(['class' => 'flex w-full justify-center backdrop-blur-sm rounded-md bg-orange-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600 ', 'type' => 'submit']) }}>
    {{ $slot }}
</button>
