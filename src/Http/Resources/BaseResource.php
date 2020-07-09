<?php

namespace Zijinghua\Zbasement\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Zijinghua\Zbasement\Http\Resources\Contracts\BaseResourceInterface;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class BaseResource extends ResourceCollection implements BaseResourceInterface
{
    protected $hiddenFields=[];

    protected $messageBody=[
        'code'=>null,
        'status'=>null,
        'message'=>null,
    ];

    public function __construct($resource, $messageBody = null)
    {
        $collection = new Collection();
        if (isset($resource)) {
            if ($resource instanceof LengthAwarePaginator) {
                $collection=$resource;
            } elseif (!($resource instanceof Collection)) {
                $arrayResource=$resource->toArray();
                $collection->push($arrayResource);
            } else {
                $collection=$resource;
            }
        }
        parent::__construct($collection);

        $this->set($messageBody);
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
//        if (!($this->resource instanceof Collection)) {
//            $res=new Collection();
//            $res->push($this->resource) ;
//            return array_merge([
//                'data' => $res->except($this->hiddenFields),
//            ], $this->messageBody);
//        }
//        return [ 'data' => $this->collection, $this->messageBody];
//        return [ 'data' => $this->collection->except($this->hiddenFields)];
        $res=$this->collection->except($this->hiddenFields);
        if (isset($this->hiddenFields)&&(!empty($this->hiddenFields))) {
            return array_merge([
                'data' => $res,
            ], $this->messageBody);
        } else {
            return array_merge(['data' => $this->collection], $this->messageBody);
        }

//        return array_merge(['data' => $this->collection->except($this->hiddenFields),], $this->messageBody);
    }
}
