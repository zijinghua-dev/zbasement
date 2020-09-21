<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Models\Traits\SoftDelete;
use Zijinghua\Zbasement\Http\Repositories\Contracts\BaseRepositoryInterface;
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseRepository implements BaseRepositoryInterface
{
    use Slug,SoftDelete;

    //输入参数过滤，只留下search,showsoftdelete,sort(orderby,sort_direction),pageindex
    //content=>{item=>{key=>field,key=>value,key=>filter,key=>alg}
    protected function getIndexParameter($data){
        $search=[];
        $showSoftDelete=null;
        $sort=null;
        $pageIndex=null;
        if(isset($data['search'])){
            $search=$data['search'];
        }
        if(isset($data['showSoftDelete'])){
            $showSoftDelete=$data['showSoftDelete'];
        }
        if(isset($data['sort'])){
            $sort=$data['sort'];
        }
        if(isset($data['pageIndex'])){
            $pageIndex=$data['pageIndex'];
        }
        return ['search'=>$search,'showSoftDelete'=>$showSoftDelete,'sort'=>$sort,'pageIndex'=>$pageIndex];
    }
    public function fetch($data){
        if(isset($data['search'])){
            $parameters=$this->getIndexParameter($data);
            $model=$this->find($parameters);
        }else{
            $model=$this->normalFind($data);
        }
        if(isset($model)) {
            return $model->first();
        }
    }

    public function find($data){
        $model=Zsystem::model($this->getSlug());
        foreach ($data['search'] as $items){
            $field=null;
            $fieldValue=null;
            $filter='=';
            $algorithm='or';
            foreach ($items as $key =>$value){
                switch ($key){
                    case 'field':
                        $field=$value;
//                        if(!$this->fieldExist($field)){
//                            throw new Exception('数据对象'.$this->slug.'没有'.$field.'字段。');
//                        }
                        //如果这个字段不在系统里，或者不能搜索，应当报错
                        break;
                    case 'filter':
                        $filter=$value;
                        break;
                    case 'value':
                        $fieldValue=$value;
                        break;
                    case 'algorithm':
                        $algorithm=$value;
                        break;
                }
            }
            if($field){
                if($algorithm=='and'){
                    if($filter=='in'){
                        $model=$model->whereIn($field,$fieldValue);
                    }elseif(!$filter){
                        $model=$model->where($field,$fieldValue);
                    }else{
                        $model=$model->where($field,$filter,$fieldValue);
                    }

                }elseif($algorithm=='or'){
                    if($filter=='in'){
                        $model=$model->orWhereIn($field,$fieldValue);
                    }elseif(!$filter){
                        $model=$model->orWhere($field,$fieldValue);
                    }else{
                        $model=$model->orWhere($field,$filter,$fieldValue);
                    }
                }

            }else{
                return;
            }
        }
        return $model;
    }

    public function normalFind($data)
    {
        $model = Zsystem::model($this->getSlug());
        $builder=$model;
        if(isset($data)){
            foreach ($data as $key=>$value){
                if ($model->fieldExist($key))
                {
                    $builder= $builder->where($key,$value);
                }
            }
        }

        return $builder;
    }

    //index有两种参数输入方式：一个是并列输入，一个是经过search参数输入
    public function index($data){
        if(isset($data['paginate'])){
            $paginate=$data['paginate'];
            if($paginate>getConfigValue('paginate',15)){
                $paginate=getConfigValue('paginate',15);
            }
        }else{
            $paginate=0;
        }

        if(isset($data['search'])){
            $parameters=$this->getIndexParameter($data);
            $model=$this->find($parameters);
        }else{
            $model=$this->normalFind($data);
        }

        if(isset($model)) {
            if($paginate){
                return $model->paginate($paginate);
            }
            return $model->get();
        }
    }

//    public function fieldExist($field){
//        $model=$this->model($this->slug);
//        return $model->fieldExist($field);
//    }

    public function first($field, $value){
        $model=$this->model($this->getSlug());
        return $model::where($field, $value)->first();
    }

    //不同于index和search，all没有分页功能
    //all主要是给内部调用，一次性返回全部数据，所以，需要调用者考虑性能
    public function all($fields){
        $model=$this->model($this->getSlug());
        return $model::select($fields)->get();
    }

    //$index对应的是位置，不是id
    public function get($index,$num){
        $model=$this->model($this->getSlug());
        return $model::offset($index)->limit($num)->orderBy('id','asc')->get();
    }

    //$parameters为数组，键值对形式
    public function store($parameters){
        //这里要进行参数过滤
        //暂不支持批量插入
        $model=$this->model();
        //所有model都要实现fill方法，对输入参数进行过滤
        $model->fill($parameters);
//        foreach ($parameters as $key => $value){
//            $model->$key=$value;
//        }
        $model->save();
        return $model;
    }

    //$parameters为数组，键值对形式，需要调用者处理参数，并且，一次只能一条
    //不会重复插入
    public function save($parameters){
        //这里要进行参数过滤
        //暂不支持批量插入
        $model=$this->model();
        //所有model都要实现fill方法，对输入参数进行过滤
        $result=$model->firstOrCreate($parameters);
        return $result;
    }

    public function show($data){
        $model=$this->model();
        $id=$data['id'];
        return $model->where('id', $id)->first();
    }

    //update,必须含有uuid
    public function update($data){
        $model=$this->model();
        $id=$data['id'];
        unset($data['id']);
        $result=$model->where('id',$id)->update($data);
        return $result;
    }

    //updateOrCreat的第一个参数是条件，第二个参数是创建参数
    public function updateOrCreate($data){
        $model=$this->model($this->getSlug());
        if(count($data)>1){
            $result=$model->updateOrCreate($data[0],$data[1]);
            return $result;
        }elseif(count($data)==1){
            if(isset($data['id'])){
                $id=$data['id'];
                unset($data['id']);
                $result=$model->where('id',$id)->update($data);
                return $result;
            }else{
                $result=$model->updateOrCreate($data);
                return $result;
            }
        }
    }

    public function model($slug=null){
        if(isset($slug)){
            return Zsystem::model($slug);
        }
        return Zsystem::model($this->getSlug());
    }

    public function fields($fields){
        $model=$this->model($this->getSlug());
        return $model->fields($fields);
    }

//    public function all($fields){
//        $model=$this->model($this->getSlug());
//        return $model->fields($fields);
//    }

//如果调用者自己不拼装查询参数，那么这个方法查询name字段
    public function key($name){

        if(!is_array($name)){
            $parameter['search'][]=['field'=>'name','value'=>$name,'filter'=>'=','algorithm'=>'or'];
//            $parameter['search'][]=['field'=>'slug','value'=>$name,'filter'=>'=','algorithm'=>'or'];
        }else{
            $parameter=$name;
        }
        $object=$this->fetch($parameter);
        if(isset($object)){
            return $object->id;
        }
    }


    //输入参数仍然是search格式，但是，filter变成In，支持批量删除
    public function delete($parameters){
        if(isset($parameters['search'])){
            $parameters=$this->getIndexParameter($parameters);
            $model=$this->find($parameters);
        }else{
            $model=$this->normalFind($parameters);
        }

        if(config('softdelete',false)){
            $result= $model->forceDelete();
        }
        $result=$model->delete();
        return $result;
//        return $model->softDelete();
    }

    //输入参数不同：删除slug对应的$parameters中的ID，输入参数必须由调用者先处理好
    //多个参数是并列关系，不支持批量删除
    protected function destroy($parameters){
        //单一删除
        $model=$this->model($parameters->slug);
        foreach ($parameters as $key =>$value){
            if(is_array($parameters[$key])){
                $value=$parameters[$key];
                $model = $model::whereIn($key, $value);
            }else{
                $model = $model::where($key, $value);
            }
        }
        return $model->softDelete();
    }

//    //输入格式：field=>value，全部为并且关系，支持value为数组
//    public function remove($parameters){
//        $model=$this->model($this->getSlug());
//
//        foreach ($parameters as $key =>$value){
//            if(is_array($parameters[$key])){
//                $value=$parameters[$key];
//                $where[] = [function($query) use ($key,$value){
//                    $query->whereIn($key, $value);
//                }];
//            }else{
//                $where[$key]=$value;
//            }
//        }
//        $model = $model::where($where);
//        return $this->softDelete($model);
//    }

    public function with($function,$parameters=[]){
        $model=$this->model($this->getSlug());
        if(isset($parameters)) {
            $result = $model::with([$function => function ($query) use ($parameters) {
                foreach ($parameters as $key=>$value){
                    $query->where($key, '=', $value);
                }
            }]);
            return $result;
        }
//        $result=$result->get();
//        $result= $result->wherePivot($pivotField, '=', $pivotValue);
//        $result=$model->with($result);
        return $model->with($function);
//        DB::enableQueryLog();
//        $result=$result->get();
//        $sql=DB::getQueryLog();
//        if(isset($pivotField)){
//            $result= $model::with([$table=>function ( $query) use ($pivotField,$pivotValue){
//                $query->where($pivotField, '=', $pivotValue);
//            }]);
//            return $result;
//        }
//        return $model::with($table);
    }

    public function whereHas($function,$parameters=[]){
        $model=$this->model($this->getSlug());

        if(isset($parameters)){
            return $model::whereHas($function, function ($query) use ($parameters){
                foreach ($parameters as $key=>$value){
                    $query->where($key, '=', $value);
                }
            });
        }
        return $model::whereHas($function);
    }

    public function withAndHas($function, $parameters=[]){
        $model=$this->model($this->getSlug());

        if(isset($parameters)){
            $result= $model::whereHas($function, function ($query) use ($parameters){
                foreach ($parameters as $key=>$value){
                    $query->where($key, '=', $value);
                }

            });
            $result=  $result->with([$function => function ($query) use ($parameters) {
                foreach ($parameters as $key=>$value){
                    $query->where($key, '=', $value);
                }
            }]);
            return $result;
        }
        return $model::whereHas($function);
    }

    public function pivotFilter($function,$parameters=[],$type=null){
        switch($type){
            case 1:
                return $this->with($function,$parameters)->get();
            case 2:
                return $this->whereHas($function,$parameters)->get();
            default:
                return $this->withAndHas($function,$parameters)->get();
        }
    }


    public function relation($parameters){
        $model=$this->model($this->getSlug());
        $model=$model->with($parameters['function']);
        if($parameters) {
            foreach ($parameters['data'] as $key=>$value){
                $model = $model->where($key, '=', $value);
            }
        }

        return $model->get();
    }

}
