<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Zijinghua\Zbasement\Http\Traits\Slug;

class CodeMessageRepository extends BaseRepository
{
    public $slug='codeMessage';

    public function fieldExist($field){
        $model=$this->model($this->getSlug());
        return $model->fieldExist($field);
    }

    public function first($field, $value){
        $model=$this->model();
        $result= $model->first($field, $value);
        return $result;
    }


}