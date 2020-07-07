<?php


namespace Zijinghua\Basement\Events\Api;

class InterfaceBeforeEvent extends AppEvent
{
    public $requestName;
    public $request;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        //去掉命名空间/路径，只保留request的类名
        $this->requestName=class_basename($request);
        $this->request=$request;
    }
}
