<?php

namespace Zijinghua\Zbasement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Zijinghua\Zbasement\Events\Api\InterfaceAfterEvent;
use Zijinghua\Zbasement\Events\Api\InterfaceBeforeEvent;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Requests\FetchRequest;
use Zijinghua\Zbasement\Http\Requests\IndexRequest;
use Zijinghua\Zbasement\Http\Requests\ShowRequest;
use Zijinghua\Zbasement\Http\Requests\StoreRequest;
use Zijinghua\Zbasement\Http\Requests\UpdateRequest;

class BaseController extends Controller
{
    protected $slug;
    public function execute($request,$action){
        //发送事件
        event(new InterfaceBeforeEvent($request));
        //从request里获取参数（slug，查询参数）----记得在service里面过滤参数，去掉不用的参数
        //找到对应的resource类
        if(!isset($this->slug)){
            $this->slug=getSlug($request);
        }

        $data=$request->all();
        $service=$this->service($this->slug);
        $message= $service->$action($data);
        $response=$message->response();
        event(new InterfaceAfterEvent($request,$response));
        return $response;
    }

//    public function edit(EditRequst $request){
//      return  $this->execute($request,'edit');
//    }

    public function update(UpdateRequest $request){
       return  $this->execute($request,'update');
    }
    public function delete(DeleteRequest $request){
        $this->execute($request,'delete');
    }

    public function index(IndexRequest $request){
        //前端将搜索内容放在请求体内，以json形式，将搜索参数用键值对保存到数组里
        //pageIndex（目标页），orderby（排序字段），sort_order（顺序倒序），showSoftDeletes，[key ,filter,value](and or),
        //indexrequest的权限还要处理搜索字段，不能有禁止搜索的字段
        return $this->execute($request,'index');
    }

    //StoreRequest
    public function store(StoreRequest $request){
        $response=$this->execute($request,'store');
        return $response;
    }

    public function show(ShowRequest $request){
        return $this->execute($request,'show');
    }

    public function service($slug){
        $service=Zsystem::service($slug);
        return $service;
    }

    public function fetch(FetchRequest $request){
        return $this->execute($request,'fetch');
    }

}
