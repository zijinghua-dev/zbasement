<?php

namespace Zijinghua\Zbasement\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Zijinghua\Zbasement\Http\Models\Traits\UuidTrait;
/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
abstract class BaseModel extends Model
{
//    use UuidTrait;
    use SoftDeletes;

    protected $fillable = [
    ];

//    protected $hidden = [
//        'id',
//    ];

    public function unsetRelation($relation)
    {
        unset($this->relations[$relation]);

        return $this;
    }

    public function fieldExist($field){
        return Schema::hasColumn($this->table, $field);
    }

    public function fields($fields){
        $columns=Schema::getColumnListing($this->table);
        $result=array_intersect($fields,$columns);
        return $result;
    }

    public function softDelete(){
        if(config('softdelete',true)){
            return $this->forceDelete();
        }
        return $this->delete();
    }
}
