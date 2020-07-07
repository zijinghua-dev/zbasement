<?php
function getConfigValue(string $config)
{
    $value = config($config, null);
    if (!$value) {
        throw new Exception('请配置'.$config);
    }

    return $value;
}

//下划线命名到驼峰命名
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
//不能是空，不能是null，不能是空格
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

//必须是整数，不能是零，不能是null;可以是字符串型的整数
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

/**
 * 对象 转 数组
 *
 * @param object $obj 对象
 * @return array
 */
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
