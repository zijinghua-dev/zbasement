<?php

namespace Zijinghua\Basement\Listeners\Api;

use App\Events\Api\InterfaceAfterEvent;
use App\Logs\AppLog;

class InterfaceAfterListener
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function handle(InterfaceAfterEvent $event)
    {
        $log=new AppLog();
        $log->saveResponse($event->request, $event->response);
    }
}
