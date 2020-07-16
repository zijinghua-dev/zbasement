<?php


namespace Zijinghua\Zbasement\Http\Services;


use Zijinghua\Zbasement\Http\Services\Contracts\ValidationServiceInterface;
use Zijinghua\Zbasement\Rules\Has;
use Zijinghua\Zbasement\Rules\Unique;
class ValidationService extends BaseService implements ValidationServiceInterface
{
    public function rules($slug, $action){
        $repository=$this->repository();
        //把格式更换为两层数组格式
        $rules=$repository->rules($slug, $action);
        $rules=$this->changeCustomRule($rules);
        return $this->messageResponse('ZBASEMENT_CODE_'.$slug.'_'.$action.'_LOAD_RULES',$rules);

    }
    public function messages($slug, $action){
        $repository=$this->repository('validation');
        //把格式更换为两层数组格式
        $messages=$repository->messages($slug, $action);
        return $this->messageResponse('ZBASEMENT_CODE_'.$slug.'_'.$action.'_LOAD_MESSAGES',$messages);
    }

    //不能输入空字符串
    public function changeCustomRule($rules){
        foreach ($rules as $field => $items){
            foreach ($items as $key => $rule) {
                //获取第一个空格分隔的字符片段
                $strings=explode(" ", $rule);
                //转换为小写
                $firstWord=strtolower($strings[0]);
                //判断是不是new
                if($firstWord!='new'){
                    continue;
                }
                if(!isset($strings[1])){
                    continue;
                }
                //将第二个片段再次用冒号分隔
                $classParameters=explode(":", $strings[1]);
                $class=$classParameters[0];
                //转换为开头大写
                $class=ucfirst($class);
                //将后面参数用逗号分隔
                if(isset($classParameters[1])){
                    $parameters=$classParameters[1];
                    $parameters=explode(",", $parameters);
                    $rules[$field][$key]=new $class($parameters);
                }else{
                    $rules[$field][$key]=new $class();
                }

                //执行该方法

            }
        }
        return $rules;
    }
}
