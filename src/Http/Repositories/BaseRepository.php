<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Exception;
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
        $model=$this->find($data);
        if(isset($model)){
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
            if($field&&$fieldValue){
                if($algorithm=='and'){
                    if($filter){
                        $model=$model->where($field,$filter,$fieldValue);
                    }else{
                        $model=$model->where($field,$fieldValue);
                    }

                }elseif($algorithm=='or'){
                    if($filter){
                        $model=$model->orWhere($field,$filter,$fieldValue);
                    }else{
                        $model=$model->orWhere($field,$fieldValue);
                    }
                }

            }else{
                return;
            }
        }
        return $model;
    }
    public function index($data){
        $parameters=$this->getIndexParameter($data);
        $paginate=getConfigValue('paginate',15);

        $model=$this->find($parameters);
        if(isset($model)) {
            return $model->paginate($paginate);
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

    //$parameters为数组，键值对形式
    public function store($parameters){
        //这里要进行参数过滤
        $model=$this->model();
        //所有model都要实现fill方法，对输入参数进行过滤
        $model->fill($parameters);
//        foreach ($parameters as $key => $value){
//            $model->$key=$value;
//        }
        $model->save();
        return $model;
    }

    public function show($data){
        $uuid=$data['uuid'];
        $model=$this->model();
        return $model->where('uuid', $uuid)->first();
    }

    //update,必须含有uuid
    public function update($data){
        $model=$this->model();
        $uuid=$data['uuid'];
        unset($data['uuid']);
        $model->where('uuid',$uuid)->update($data);
        return true;
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

    public function key($name){
        $parameter=$name;
        if(is_string($name)){
            $parameter['search'][]=['field'=>'name','value'=>$name];
        }
        $object=$this->fetch($parameter);
        if(isset($object)){
            return $object->id;
        }
    }



    public function delete($parameters){
        //批量删除
        $parameters=$this->getIndexParameter($parameters);

        $model=$this->find($parameters);
        return $model->softDelete();
    }

    public function destroy($parameters){
        //单一删除
        $parameters=$this->getIndexParameter($parameters);

        $model=$this->find($parameters);
        return $model->softDelete();

    }

    public function clear($parameters){
        //组内移除，并不删除
        //必须通过group_objects model来做
        $this->setSlug('groupObject');
        //组内移除需要将uuid变成 object_id，

        foreach ($parameters['search'] as $key=>$item){
            if($item['field']=='uuid'){
                $parameters['search'] [$key]['field']='object_uuid';
            }
        }

        $model=$this->find($parameters);
        return $model->softDelete();
    }


}