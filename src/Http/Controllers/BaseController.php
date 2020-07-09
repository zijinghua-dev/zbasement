<?php

namespace Zijinghua\Zbasement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Zijinghua\Zbasement\Events\Api\InterfaceAfterEvent;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Requests\ShowRequest;
use Zijinghua\Zbasement\Http\Requests\StoreRequest;

class BaseController extends Controller
{
    private $slug;
    public function store(StoreRequest $request){
        //发送事件
        event(new InterfaceBeforeEvent($request));
        //从request里获取参数（slug，查询参数）----记得在service里面过滤参数，去掉不用的参数
        //找到对应的resource类
        if(!isset($this->slug)){
            $this->slug=getSlug($request);
        }

        $data=$request->all();
        $message= $this->service($this->slug)->store($data);
        $response=$message->response();
        event(new InterfaceAfterEvent($request,$response));
        return $response;
    }

    public function show(ShowRequest $request){
        event(new InterfaceBeforeEvent($request));
        if(!isset($this->slug)){
            $this->slug=getSlug($request);
        }
        $uuid=$request->route('uuid');
        $message=$this->service($this->slug)->show($uuid);
        $response=$message->response();
        event(new InterfaceAfterEvent($request,$response));
        return $response;
    }

    public function service($slug){
        $service=Zsystem::service($slug);
        return $service;
    }



}