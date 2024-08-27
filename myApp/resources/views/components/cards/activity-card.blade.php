@props(['activity'])

@if (
    $activity->activity_type == 'Enrolled' ||
        strpos($activity->activity_type, 'Completed') ||
        strpos($activity->activity_type, 'Uploaded'))
    <div class=" flex  justify-between items-center space-y-1 w-full bg-green-100 shadow-sm p-3 rounded-md">
        <div class=" ">
            <h3 class=" text-green-700">{{ $activity->activity_type }}</h3>
            <p class="text-sm text-gray-700">{{ $activity->description }}</p>
        </div>
        <div>
            <p class="text-sm text-green-600">
                {{ $activity->created_at->format('M d, Y | h:i a') }}
            </p>
        </div>
    </div>
@else
    <div class=" flex  justify-between items-center space-y-1 w-full bg-red-100 shadow-sm p-3 rounded-md">
        <div class=" ">
            <h3 class=" text-red-700">{{ $activity->activity_type }}</h3>
            <p class="text-sm text-gray-700">{{ $activity->description }}</p>
        </div>
        <div>
            <p class="text-sm text-red-600">
                {{ $activity->created_at->format('M d, Y | h:i a') }}
            </p>
        </div>
    </div>
@endif
