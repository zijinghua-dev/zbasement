<?php

namespace Zijinghua\Zbasement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Controllers\Requests\ShowRequest;
use Zijinghua\Zbasement\Http\Requests\StoreRequest;

class BaseController extends Controller
{
    private $slug;
    public function store(StoreRequest $request){
        $slug=$this->getSlug($request);
        $data=$request->all();
        $message= $this->service($slug)->store($data);
        $response=$message->response();
        return $response;
    }

    public function show(ShowRequest $request){
        $slug=$this->getSlug($request);
        $uuid=$request->route('uuid');
        $this->service($slug)->show($uuid);
    }

    public function service($slug){
        $service=Zsystem::service($slug);
        return $service;
    }

    public function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $path=$request->path();
            $slug = explode('/', $path)[1];
//            $slug = explode('.', $request->route()->getName())[0];
        }

        return $slug;
    }

}