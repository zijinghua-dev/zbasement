<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Zijinghua\Zbasement\Http\Contracts\UserRepositoryInterface;
use Zijinghua\Zbasement\Http\Repositories\BaseRepository;

class RestfulUserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function fetch($data){
        $model=$this->model($this->getSlug());
        return $model->fetch($data);
    }
}