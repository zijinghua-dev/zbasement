<?php


namespace Zijinghua\Zbasement;

use Exception;
use Illuminate\Support\Str;

class Zsystem
{
    public function model($slug=null){
        $object=$this->reflectClass($slug, 'model');
        if (!$object) {
                throw new Exception('数据库模型'.$slug.'类丢失。');
        }
//        $object->setSlug($slug);
        return $object;
    }

    public function service($slug=null){
        if(!isset($slug)) {
            $slug='base';
        }
        return $this->getObject($slug, 'service');
    }
    /**
     * @param $slug
     * 查找有没有$slug+repository的类
     */
    public function repository($slug=null){
        if(!isset($slug)) {
            $slug='base';
        }
        return $this->getObject($slug, 'repository');
    }

    protected function getObject($slug,$classType) {
        $object=$this->reflectClass($slug, $classType);
        if (!$object) {
            //如果这个类没有找到，就找这个类的默认类
            $object=$this->reflectClass('Base', $classType);
            if (!$object) {
                throw new Exception('Base'.$classType.'类丢失。');
            }
        }
        $object->setSlug($slug);
        return $object;
    }

    protected function getNamespace()
    {
        return (new \ReflectionClass($this))->getNamespaceName();
    }

    /**
     * @param $slug
     * @param $classType
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * 类名都是大写开头，别名都是小写开头，但slug有可能不是，所以需要转换
     */
    //获取http目录下的类,model,repository,service,controller，这些类必须要已经注入到容器
    //$slug,$classType必须是驼峰形式
    protected function reflectClass($slug,$classType)
    {
        //先把slug转为大写开头
        $slug=ucfirst($slug);
        $classType = ucfirst($classType);

//        //类型对应的路径名称是复数
//        $classNameSpace=Str::plural($classType);
        $className=$slug.$classType;
        //因为绑定的别名都是首字母小写
        $className=lcfirst($className);
//        $classFullName= $this->getNamespace().'\\Http\\'.$classNameSpace.'\\'.$className;
        if (app()->bound($className) ) {
            return app()->make($className);
        }
    }

    public function routes()
    {
        require __DIR__.'/../routes/snack.php';
    }
}