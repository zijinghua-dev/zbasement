<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Zijinghua\Zbasement\Http\Repositories\Contracts\UserRepositoryInterface;


class RestfulUserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function fetch($data){
        $model=$this->model($this->getSlug());
        return $model->fetch($data);
    }

    public function store($data){
        $model=$this->model($this->getSlug());
        return $model->store($data);
    }

    public function show($data){
        $model=$this->model($this->getSlug());
        return $model->show($data);
    }

    public function update($data){
        $model=$this->model($this->getSlug());
        return $model->update($data);
    }

    public function index($data){
        $model=$this->model($this->getSlug());
        return $model->index($data);
    }

    public function transferKey($uuid){
        $model=$this->model($this->getSlug());
        return $model->transferKey($uuid);
//        if(isset($object)){
//            if(isset($item['id'])){
//                return $object->uuid;
//            }else{
//                return $object->id;
//            }
//        }
    }
}