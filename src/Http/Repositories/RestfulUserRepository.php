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
}