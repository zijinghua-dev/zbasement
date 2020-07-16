<?php


namespace Zijinghua\Zbasement;

use Exception;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Str;

class Zsystem
{
    public function resource($slug=null,$bread_action=null){
        //资源类的规则是：第一是slug+action,然后是slug，然后是base
        if(isset($slug)) {
            $secondTryName = $slug;
            if (isset($bread_action)) {
                $firstTryName = $slug . ucfirst($bread_action);
            }
        }
        $class=$this->reflectClass($firstTryName, 'resource');
        if ($class) {
            return $class;
        }
        //再找slug类
        $class=$this->reflectClass($secondTryName, 'resource');
        if ($class) {
            return $class;
        }
        //最后是base
        $class=$this->reflectClass('Base', 'resource');
        if ($class) {
             return $class;
        }
        throw new Exception('Baseresource资源类丢失。');
    }

    public function model($slug=null){
        $object=$this->reflectObject($slug, 'model');
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

    protected function getClass($slug,$classType) {
        $class=$this->reflectClass($slug, $classType);
        if (!$class) {
            //如果这个类没有找到，就找这个类的默认类
            $class=$this->reflectClass('Base', $classType);
            if (!$class) {
                throw new Exception('Base'.$classType.'类丢失。');
            }
        }
        return $class;
    }

    protected function getObject($slug,$classType) {
        $object=$this->reflectObject($slug, $classType);
        if (!$object) {
            //如果这个类没有找到，就找这个类的默认类
            $object=$this->reflectObject('Base', $classType);
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
    protected function reflectObject($slug,$classType)
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
        $loader = AliasLoader::getInstance();
        $aliases=$loader->getAliases();
        if(isset($aliases[$className])){
            return $aliases[$className];
        }

//        if(app()->aliases[$className]){
//            return $this->aliases[$className];
//        }
    }

    public function routes()
    {
        require __DIR__.'/../routes/snack.php';
    }
}
