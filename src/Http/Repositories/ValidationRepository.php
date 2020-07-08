<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Illuminate\Support\Collection;
use Zijinghua\Zbasement\Http\Traits\Slug;
use Zijinghua\Zbasement\Http\Repositories\Contracts\ValidationRepositoryInterface;

class ValidationRepository extends BaseRepository implements ValidationRepositoryInterface
{
    use Slug;
    public function rules($slug, $action){
        $result=$this->getRulesFromConfig($slug, $action);
        return $result;
    }
    public function getRulesFromConfig($slug, $action){
        $model=$this->model('validation');
        $data=$model->rules($slug);
        //转换成两层数组格式
        $result=[];
        foreach ($data as  $field => $items){
            foreach ($items as $item){
                $searchResult=array_search($action, $item['action']);
                if (($searchResult===0)||($searchResult)){
                    foreach ($item['rule'] as $rule){
                        $result[$field][]=$rule;
                    }
                }
            }
        }
        return $result;
    }
    public function messages($slug, $action){
        $result=$this->getMessagesFromConfig($slug, $action);
        return $result;
    }

    public function getMessagesFromConfig($slug, $action){
        $model=$this->model('validation');
        $data=$model->messages($slug);
        //转换成两层数组格式
        $result=[];
        foreach ($data as  $field => $items){
            foreach ($items as $item){
                $searchResult=array_search($action, $item['action']);
                if (($searchResult===0)||($searchResult)) {
                    foreach ($item['message'] as $key => $message){
                        $result[$field][$key]=$message;
                    }
                }
            }
        }
        return $result;
    }
}