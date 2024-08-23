<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($activityType, $description = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => $activityType,
            'description' => $description,
        ]);
    }
}
