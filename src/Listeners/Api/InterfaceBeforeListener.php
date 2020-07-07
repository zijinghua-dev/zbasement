<?php


namespace Zijinghua\Basement\Listeners\Api;

use App\Events\Api\InterfaceBeforeEvent;
use App\Logs\AppLog;

class InterfaceBeforeListener
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function handle(InterfaceBeforeEvent $event)
    {
        $log=new AppLog();
        $log->saveRequest($event->request);
    }
}
