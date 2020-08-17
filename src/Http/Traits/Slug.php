<?php
namespace Zijinghua\Zbasement\Http\Traits;

use Illuminate\Support\Str;

trait Slug
{
    private $slug;
    public function setSlug($slug){
        //如果是复数，转成单数
        $slug=Str::singular($slug);
        //首字符小写
        $slug=lcfirst($slug);
        $this->slug=$slug;
    }
    public function getSlug(){
        return $this->slug;
    }
}