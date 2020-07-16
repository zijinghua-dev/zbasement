<?php
namespace Zijinghua\Zbasement\Observers;

use Spatie\Activitylog\Models\Activity;

class ActivityObserver
{
    protected function isTesting()
    {
        return strtolower(env('APP_ENV'))==='testing';
    }
    public function created(Activity $activity)
    {
       !$this->isTesting() && \Log::channel('activity_log')->info('activity', $activity->toArray());
    }

    public function updated(Activity $activity)
    {
        !$this->isTesting() && \Log::channel('activity_log')->info('activity', $activity->toArray());
    }

    public function deleted(Activity $activity)
    {
        !$this->isTesting() && \Log::channel('activity_log')->info('activity', $activity->toArray());
    }
}
