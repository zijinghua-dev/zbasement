<?php


namespace Zijinghua\Zbasement\Http\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Zijinghua\Zbasement\Http\Models\Contracts\UserModelInterface;

class RestfulUser extends ResfulModel implements UserModelInterface,    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    protected $fillable=[];
//    public function getUsernameAttribute()
//    {
//        if(isset($this->data)){
//            return $this->data[0]->username;
//        }
//
//    }
//
//    public function getPasswordAttribute()
//    {
//        if(isset($this->data)){
//            return $this->data[0]->password;
//        }
//
//    }
    public function fetch($data){
//        $host=getConfigValue('zvoyager');
//        $host=getConfigValue('zvoyager.usercenter');
        $host=getConfigValue('zbasement.usercenter.host');

        $fetchUri=getConfigValue('zbasement.usercenter.api.fetch.uri');
        $action=getConfigValue('zbasement.usercenter.api.fetch.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $data=$this->connect($action,$fetchUri,$data);
        if(isset($data)){
            $this->fill($data[0]);
            return $this;
        }

    }

    public function store($data){
//        $host=getConfigValue('zvoyager');
//        $host=getConfigValue('zvoyager.usercenter');
        $host=getConfigValue('zbasement.usercenter.host');

        $fetchUri=getConfigValue('zbasement.usercenter.api.store.uri');
        $action=getConfigValue('zbasement.usercenter.api.store.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $data=$this->connect($action,$fetchUri,$data);
        $this->fill($data[0]);
        return $this;
    }
}