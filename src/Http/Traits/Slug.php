<?php
namespace Zijinghua\Zbasement\Http\Traits;

trait Slug
{
    private $slug;
    public function setSlug($slug){
        $this->slug=$slug;
    }
    public function getSlug(){
        return $this->slug;
    }
}