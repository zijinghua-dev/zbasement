<?php


namespace Zijinghua\Zbasement\Http\Repositories;


use Illuminate\Support\Collection;
use Zijinghua\Zbasement\Http\Traits\Slug;
use Zijinghua\Zbasement\Http\Repositories\Contracts\ValidationRepositoryInterface;

class ValidationRepository extends BaseRepository implements ValidationRepositoryInterface
{
    use Slug;
    public function rules($slug, $action){
        //先加载无slug的rules，再去找有slug的rules
        $withoutSlug=$this->getRulesFromConfig('base', $action);
        $hasSlug=$this->getRulesFromConfig($slug, $action);
//        if(emptyObjectOrArray($result))
        return array_merge_recursive($withoutSlug,$hasSlug);
    }
    public function getRulesFromConfig($slug, $action){
        $model=$this->model('validation');
        $data=$model->rules($slug);
//        if(!isset($data)||empty($data)){
//            $data=$model->rules(null);
//        }
        if(!isset($data)||empty($data)){
            return[];
        }
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
//        $result=$this->getMessagesFromConfig($slug, $action);
//        return $result;
        //先加载无slug的messages，再去找有slug的messages
        $withoutSlug=$this->getMessagesFromConfig('base', $action);
        $hasSlug=$this->getMessagesFromConfig($slug, $action);
//        if(emptyObjectOrArray($result))
        return array_merge_recursive($withoutSlug,$hasSlug);
    }

    public function getMessagesFromConfig($slug, $action){
        $model=$this->model('validation');
        $data=$model->messages($slug);
//        if(!isset($data)||empty($data)){
//            $data=$model->messages(null);
//        }
        if(!isset($data)||empty($data)){
            return[];
        }
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