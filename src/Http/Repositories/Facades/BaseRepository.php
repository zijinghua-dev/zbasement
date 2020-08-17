<?php


namespace Zijinghua\Basement\Http\Repositories\Facades;


use Illuminate\Support\Facades\Facade;

class BaseRepository extends Facade
{
    protected static function getFacadeAccessor() { return 'baseRepository'; }
}