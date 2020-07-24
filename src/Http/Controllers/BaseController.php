<?php

namespace Zijinghua\Zbasement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Zijinghua\Zbasement\Events\Api\InterfaceAfterEvent;
use Zijinghua\Zbasement\Events\Api\InterfaceBeforeEvent;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Requests\ClearRequest;
use Zijinghua\Zbasement\Http\Requests\DeleteRequest;
use Zijinghua\Zbasement\Http\Requests\DestroyRequest;
use Zijinghua\Zbasement\Http\Requests\FetchRequest;
use Zijinghua\Zbasement\Http\Requests\IndexRequest;
use Zijinghua\Zbasement\Http\Requests\ShowRequest;
use Zijinghua\Zbasement\Http\Requests\StoreRequest;
use Zijinghua\Zbasement\Http\Requests\UpdateRequest;
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseController extends Controller
{
    use Slug;
    public function execute($request,$action){
        //发送事件
        event(new InterfaceBeforeEvent($request));
        //从request里获取参数（slug，查询参数）----记得在service里面过滤参数，去掉不用的参数
        //找到对应的resource类
        if(empty($this->getSlug())){
            $this->setSlug(getSlug($request));
        }

        $data=$request->all();
        $service=$this->service($this->getSlug());
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

    //从组内移除，并不删除
    public function clear(ClearRequest $request){
        return  $this->execute($request,'clear');
    }

    //批量删除
    public function delete(DeleteRequest $request){
        return  $this->execute($request,'delete');
    }

    //单一删除
    public function destroy(DestroyRequest $request){
        return  $this->execute($request,'destroy');
    }

    //index涉及到返回的数据包要
    public function index(IndexRequest $request){
        //前端将搜索内容放在请求体内，以json形式，将搜索参数用键值对保存到数组里
        //pageIndex（目标页），orderby（排序字段），sort_order（顺序倒序），showSoftDeletes，[key ,filter,value](and or),
        //indexrequest的权限还要处理搜索字段，不能有禁止搜索的字段
        //发送事件
        event(new InterfaceBeforeEvent($request));
        //从request里获取参数（slug，查询参数）----记得在service里面过滤参数，去掉不用的参数
        //找到对应的resource类
        if(empty($this->getSlug())){
            $this->setSlug(getSlug($request));
        }

        $data=$request->all();
        $service=$this->service($this->getSlug());
        $message= $service->index($data);
        $url = $request->url();
        if(!emptyObjectOrArray($message->data)){
            $message->data->setPath($url);
        }
        $response=$message->response();
        event(new InterfaceAfterEvent($request,$response));
        return $response;
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

    //fields和values
    public function search(Request $request){
        return $this->execute($request,'search');
    }

    //可输入多个字段名，查看在当前slug中是否存在，忽略key，只取第一个value，将value还原成数组形式
    public function fields(Request $request){
        return $this->execute($request,'fields');
    }
}
