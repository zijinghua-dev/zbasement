<?php

use Illuminate\Http\Request;
if (!function_exists('getConfigValue')) {
    function getConfigValue(string $config, int $default = null)
    {
        $value = config($config, $default);
        if (!$value) {
            throw new Exception('请配置' . $config);
        }

        return $value;
    }
}
//下划线命名到驼峰命名
if (!function_exists('toCamelCase')) {
    function toCamelCase($str)
    {
        $array = explode('_', $str);
        $result = $array[0];
        $len=count($array);
        if ($len>1) {
            for ($i=1; $i<$len; $i++) {
                $result.= ucfirst($array[$i]);
            }
        }
        return $result;
    }
}

/**
 * Determine if two associative arrays are similar
 *
 * Both arrays must have the same indexes with identical values
 * without respect to key ordering
 *
 * @param array $a
 * @param array $b
 * @return bool
 */
if (!function_exists('arrays_are_similar')) {
    function arrays_are_similar($a, $b)
    {
        // if the indexes don't match, return immediately
        if (count(array_diff_assoc($a, $b))) {
            return false;
        }
        // we know that the indexes, but maybe not values, match.
        // compare the values between the two arrays
        foreach ($a as $k => $v) {
            if ($v !== $b[$k]) {
                return false;
            }
        }
        // we have identical indexes, and no unequal values
        return true;
    }
}
//不能是空，不能是null，不能是空格
if (!function_exists('isEmptyOrNullString')) {
    function isEmptyOrNullString($str)
    {
        if (!isset($str)) {
            return true;
        }
        if (empty($str)) {
            return true;
        }
        if (ctype_space($str)) {
            return true;
        }
        return false;
    }
}

//必须是整数，不能是零，不能是null;可以是字符串型的整数
if (!function_exists('isZeroOrNullInteger')) {
    function isZeroOrNullInteger($str)
    {
        if (!isset($str)) {
            return true;
        }
        if (is_float($str)) {
            return true;
        }
        if (!is_numeric($str)) {
            return true;
        } else {
            if (strstr($str, '.')) {
                return true;
            }
        }
        if (empty($str)) {
            return true;
        }
        return false;
    }
}

/**
 * 对象 转 数组
 *
 * @param object $obj 对象
 * @return array
 */
if (!function_exists('objectToArray')) {
    function objectToArray($obj)
    {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)objectToArray($v);
            }
        }

        return $obj;
    }
}

if (!function_exists('emptyObject')) {
    function emptyObject($object)
    {
        if(!isset($object)){
            return false;
        }
        return !get_object_vars($object);
    }
}

if (!function_exists('emptyObjectOrArray')) {
    function emptyObjectOrArray($object)
    {
        if(is_string($object)){
            return isEmptyOrNullString($object);
        }
        if(is_int($object)){
            return isZeroOrNullInteger($object);
        }
        if (is_array($object)) {
            return empty($object);
        }
        if (is_object($object)) {
            return emptyObject($object);
        }
    }
}

if (!function_exists('perPage')) {
    function perPage($number)
    {
        $perPageMax=getConfigValue('zbasement.api.search.perpagemax');
        if(!isset($number)){
            return  getConfigValue('zbasement.api.search.perpage');
        }
        if(!is_int($number)||(empty($number)))
        {
            return  getConfigValue('zbasement.api.search.perpage');
        }
        if($number>$perPageMax){
            return $perPageMax;
        }
        return $number;
    }
}

function getSlug($request)
{
    $path=$request->path();
    $index=getConfigValue('zbasement.api.slug.index');
    $slug = explode('/', $path)[$index];

    return $slug;
}

function getUuids($request){
    if(isset($request['uuid'])){
        return $request['uuid'];
    }
    if(isset($request['uuids'])){
        return $request['uuids'];
    }
}

function getGroupUuid($request){
    if(isset($request['groupUuid'])){
        return $request['groupUuid'];
    }
}

function getRouteSlugs()
{
    $slugs  = [];
    $routes = Route::getRoutes();

    foreach ($routes as $route)
    {
        $slugs[] = $route->uri();
    }

    return array_unique($slugs);
}


