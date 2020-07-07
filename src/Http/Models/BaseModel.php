<?php

namespace Zijinghua\Zbasement\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
abstract class BaseModel extends Model
{
    use UuidTrait;

    protected $fillable = [
    ];

    protected $hidden = [
        'id',
    ];

    public function unsetRelation($relation)
    {
        unset($this->relations[$relation]);

        return $this;
    }
}
