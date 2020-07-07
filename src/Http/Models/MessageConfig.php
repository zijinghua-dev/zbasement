<?php

namespace Zijinghua\Zbasement\Http\Models;

use Illuminate\Support\Facades\Cache;
use Zijinghua\Zbasement\Http\Models\Contracts\MessageModelInterface;

class MessageConfig implements MessageModelInterface
{
    public $code;
    public $httpCode;
    public $message;
    public $status;

    public function fieldExist($field){
        $key='zbasement';
        //zbasement.code.user.login.sucess
        $config=config($key);
        $item=$config[0][0][0][0];
        $result=array_key_exists($field, $item);
        return $result;
    }

    public function first($field, $value){
//        $key='zbasement_'.$value;
        $item=$this->getMessageBodyFromCode($value);
//       if(isset($item)&&(!empty($item))){
           return $item;
//       }
    }

    public function getMessageBody($index)
    {
        //code转换为config文件的index

        $data = getConfigValue($index);
        if (isset($data)) {
            if (!empty($data)) {
                $data=$this->changeToCamel($data);
            }
        }

        return (object)$data;
    }

    //如果有下划线连字符，改成驼峰
    private function changeToCamel($data)
    {
        $camels=[];
        foreach ($data as $key => $value) {
            $camelKey=toCamelCase($key);
            $camels[$camelKey]=$value;
        }
        return $camels;
    }

    public function getMessageBodyFromCode($code)
    {
        //code转换为config文件的index,也就是key
        //大写下划线转为小写连字符
        $lower=strtolower($code);
        $index=str_replace("_", ".", $lower);
        $data = $this->getMessageBody($index);
        return $data;
    }
}
