<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Zijinghua\Zbasement\Http\Traits\Slug;

class MessageRepository extends BaseRepository
{
    use Slug;
    public function fieldExist($field){
        $model=$this->model($this->slug);
        return $model->fieldExist($field);
    }

    public function first($field, $value){
        $model=$this->model($this->slug);
        $result= $model->first($field, $value);
        return $result;
    }


}