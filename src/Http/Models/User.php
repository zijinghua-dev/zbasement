<?php


namespace Zijinghua\Zbasement\Http\Models;

use Illuminate\Support\Facades\Schema;
use Zijinghua\Zbasement\Http\Models\BaseModel;
use Zijinghua\Zbasement\Http\Models\Contracts\UserModelInterface;

class User extends BaseModel implements UserModelInterface
{
    protected $table='users';
//    public function fieldExist($field){
//        return (Schema::hasColumn($this->table, $field));
//    }
}