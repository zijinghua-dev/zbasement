<?php


namespace Zijinghua\Zbasement\Http\Models;

use Illuminate\Support\Facades\Schema;
use Zijinghua\Zbasement\Http\Models\BaseModel;
use Zijinghua\Zbasement\Http\Models\Contracts\UserModelInterface;
use Zijinghua\Zbasement\Http\Models\Traits\UuidTrait;

class User extends BaseModel implements UserModelInterface
{
    use UuidTrait;
    protected $table='users';
//    public function fieldExist($field){
//        return (Schema::hasColumn($this->table, $field));
//    }
}