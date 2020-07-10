<?php
namespace Zijinghua\Zbasement\Observers;

use Spatie\Activitylog\Models\Activity;

class ActivityObserver
{
    public function created(Activity $activity)
    {
        \Log::channel('activity_log')->info('activity', $activity->toArray());
    }

    public function updated(Activity $activity)
    {
        \Log::channel('activity_log')->info('activity', $activity->toArray());
    }

    public function deleted(Activity $activity)
    {
        \Log::channel('activity_log')->info('activity', $activity->toArray());
    }
}