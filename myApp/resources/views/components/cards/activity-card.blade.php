@props(['activity', 'delay'])


<div data-aos="fade-right" data-aos-duration="400" data-aos-delay="{{ $delay }}"
    class=" flex space-y-3 md:space-y-1 flex-col md:flex-row justify-between md:items-center  w-full bg-[#ffffff]/5 backdrop-blur-md border-r-2 border-orange-600 shadow-sm p-3 rounded-md">
    <div class="space-y-2">
        <h3 class="text-sm lg:text-md text-orange-600 font-semibold">{{ $activity->activity_type }}</h3>
        <p class="text-xs lg:text-sm text-gray-400">{{ $activity->description }}</p>
    </div>
    <div>
        <p class="text-xs  text-gray-400">
            {{ $activity->created_at->format('M d, Y | h:i a') }}
        </p>
    </div>
</div>
