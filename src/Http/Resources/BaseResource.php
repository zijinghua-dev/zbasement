<?php

namespace Zijinghua\Zbasement\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;
use Zijinghua\Zbasement\Http\Resources\Contracts\BaseResourceInterface;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class BaseResource extends ResourceCollection implements BaseResourceInterface
{
    protected  $childResource;
    protected $hiddenFields=[];

    protected $messageBody=[
        'code'=>null,
        'httpCode'=>null,
        'status'=>null,
        'message'=>null,
    ];

    protected $pool=[];
    public function __construct($resource, $messageBody = null,$childResource=null,$pool=null)
    {
        if(!emptyObjectOrArray($pool))
        $this->pool=array_merge( $this->pool,$pool);
        $collection = new Collection();
        if (isset($resource)) {
            if ($resource instanceof LengthAwarePaginator) {
                $collection=$resource;
            } elseif ($resource instanceof Collection) {
                $collection=$resource;
            } elseif(is_array($resource)) {
                $collection->push($resource);
            }elseif($resource instanceof StdClass){
                $collection->push($resource);
            }else{
                //检查附加属性
                $arrayResource=$resource->toArray();
                $collection->push($arrayResource);
            }
        }
        parent::__construct($collection);

        $this->set($messageBody);
        $this->childResource=$childResource;
    }

    public function set($messageBody)
    {
        foreach (array_keys($this->messageBody) as $key) {
            if (isset($messageBody[$key])) {
                $this->messageBody[$key]=$messageBody[$key];
            }
        }
    }

    public function toArray($request)
    {
        if(!isset($this->childResource)){
            return ['data' => $this->collection,];
        }
        return $this->childResource::collection($this->collection);
    }

    /**
     * 返回应该和资源一起返回的其他数据数组
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return array_merge($this->messageBody,$this->pool);
    }
//    public function toArray($request)
//    {
//        if (!($this->resource instanceof Collection)) {
//            $res=new Collection();
//            $res->push($this->resource) ;
//            return array_merge([
//                'data' => $res->except($this->hiddenFields),
//            ], $this->messageBody);
//        }
//        return [ 'data' => $this->collection, $this->messageBody];
//        return [ 'data' => $this->collection->except($this->hiddenFields)];
//        $res=$this->collection->except($this->hiddenFields);
//        foreach ($this->collection as $key=>$item){
//            foreach ($this->hiddenFields as $hiddenField){
//                if(isset($item[$hiddenField])){
//                    unset($item[$hiddenField]);
//                }
//            }
//            $this->collection[$key]=$item;
//        }
//        return array_merge(['data' => $this->collection], $this->messageBody);

//        $res = $this->collection->each(function ($item, $key) {
//            return collect($item)->except($this->hiddenFields)->toArray();
//        });
//        $res=$res->all();
//        if (isset($this->hiddenFields)&&(!empty($this->hiddenFields))) {
//            return array_merge([
//                'data' => $res,
//            ], $this->messageBody);
//        } else {
//            return array_merge(['data' => $this->collection], $this->messageBody);
//        }

//        return array_merge(['data' => $this->collection->except($this->hiddenFields),], $this->messageBody);
//    }
}
