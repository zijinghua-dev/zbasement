<?php
/**
 * Created by PhpStorm.
 * User: fengliang
 * Date: 2020-01-17
 * Time: 11:33
 */

//use Illuminate\Support\Str;


//$routes=getRouteSlugs();
//Route::get('login','BaseController@login');
//Route::group(['as' => 'zbasement.'], function () {
//    $pageApiVersion = \Zijinghua\Zbasement\Zsystem::getPageApiVersion();
//    $controllerNamespace = '\\' . config('zbasement.controller.namespace') . '\\';
//    try {
//        foreach (DataType::all() as $dataType) {
//            $breadController = $dataType->controller
//                ? Str::start($dataType->controller, '\\')
//                : $controllerNamespace . 'BaseController';
//
//            Route::get(strtolower($pageApiVersion) . '/' . $dataType->slug.'/{id}/restore', $breadController.'@restore')
//                ->name($dataType->slug.'.restore');
//            Route::resource(strtolower($pageApiVersion) . '/' . $dataType->slug, $breadController,[
//                'parameters' => [
//                    $dataType->slug=> 'id',
//                ]
//            ]);
//        }
//    } catch (\InvalidArgumentException $e) {
//        throw new \InvalidArgumentException("Custom routes hasn't been configured because: " . $e->getMessage(), 1);
//    } catch (\Exception $e) {
//        // do nothing, might just be because table not yet migrated.
//    }
//});


