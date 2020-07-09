<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Zijinghua\Zbasement\Facades\Zsystem;
use Zijinghua\Zbasement\Http\Repositories\Contracts\BaseRepositoryInterface;
use Zijinghua\Zbasement\Http\Traits\Slug;

class BaseRepository implements BaseRepositoryInterface
{
    use Slug;

    public function fieldExist($field){
        $model=$this->model($this->slug);
        return $model->fieldExist($field);
    }

    public function first($field, $value){
        $model=$this->model($this->slug);
        return $model::where($field, $value)->first();
    }

    public function all($field, $value){
        $model=$this->model($this->slug);
        return $model::where($field, $value)->paginate(15);
    }

    public function search($parameters){

    }

    public function store($parameters){
        //这里要进行参数过滤
        $model=$this->model();
        foreach ($parameters as $key => $value){
            $model->$key=$value;
        }
        $model->save();
    }

    public function show($uuid){
        $model=$this->model();

        return $model->where('uuid', $uuid)->first();
    }

    public function model($slug=null){
        if(isset($slug)){
            return Zsystem::model($slug);
        }
        return Zsystem::model($this->slug);
    }


}