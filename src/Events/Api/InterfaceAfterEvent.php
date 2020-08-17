<?php

namespace Zijinghua\Zbasement\Events\Api;

class InterfaceAfterEvent extends AppEvent
{
    public $request;
    public $response;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request, $response)
    {
        $this->request=$request;
        $this->response=$response;
    }
}
