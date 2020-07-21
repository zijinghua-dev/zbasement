<?php


namespace Zijinghua\Zbasement\Http\Controllers;


use Illuminate\Http\Request;

class DataRowController extends BaseController
{
    //查找字段，调用index功能
    public function search(Request $request){
        //找出slug

        return $this->execute($request,'search');
    }
}