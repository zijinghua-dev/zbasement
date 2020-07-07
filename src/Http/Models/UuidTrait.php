<?php
namespace Zijinghua\Zbasement\Http\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Database\Eloquent\Model;

trait UuidTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        static::creating(function (Model $model) {
            $model->setAttribute('uuid', (string) $model->generateNewId());
        });
    }

    /**
     * Get a new version 4 (random) UUID.
     *
     * @return UuidInterface
     */
    public function generateNewId()
    {
        return Uuid::uuid4();
    }
}
