<?php


namespace Zijinghua\Zbasement\Http\Models\Traits;


trait SoftDelete
{
    public function softDelete($model){
        if(isset($model)) {
            if(config('softdelete',true)){
                return $model->delete();

            }
            return $model->forceDelete();
        }
    }
}