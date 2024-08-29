@props(['activity'])

{{-- @if ($activity->activity_type == 'Enrolled' || strpos($activity->activity_type, 'Completed') || strpos($activity->activity_type, 'Uploaded'))
    <div
        class=" flex  justify-between items-center space-y-1 w-full bg-[#ffffff]/5 backdrop-blur-md border-r-2 border-orange-600 shadow-sm p-3 rounded-md">
        <div class=" ">
            <h3 class=" text-orange-600">{{ $activity->activity_type }}</h3>
            <p class="text-sm text-gray-400">{{ $activity->description }}</p>
        </div>
        <div>
            <p class="text-sm text-orange-600">
                {{ $activity->created_at->format('M d, Y | h:i a') }}
            </p>
        </div>
    </div> --}}
{{-- @else --}}
<div
    class=" flex  justify-between items-center space-y-1 w-full bg-[#ffffff]/5 backdrop-blur-md border-r-2 border-orange-600 shadow-sm p-3 rounded-md">
    <div class="space-y-2">
        <h3 class=" text-orange-600 font-semibold">{{ $activity->activity_type }}</h3>
        <p class="text-sm text-gray-400">{{ $activity->description }}</p>
    </div>
    <div>
        <p class=" text-sm text-gray-400">
            {{ $activity->created_at->format('M d, Y | h:i a') }}
        </p>
    </div>
</div>
{{-- @endif --}}
