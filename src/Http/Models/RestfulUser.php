<?php


namespace Zijinghua\Zbasement\Http\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function fetch($data){
//        $host=getConfigValue('zvoyager');
//        $host=getConfigValue('zvoyager.usercenter');
        $host=getConfigValue('zbasement.api.usercenter.host');

        $fetchUri=getConfigValue('zbasement.api.usercenter.api.fetch.uri');
        $action=getConfigValue('zbasement.api.usercenter.api.fetch.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $data=$this->connect($action,$fetchUri,$data);
        if(isset($data)){
            $this->fill($data[0]);
            return $this;
        }

    }

    //如果用户已经存在，返回false；网络问题，返回null；
    public function store($data){
//        $host=getConfigValue('zvoyager');
//        $host=getConfigValue('zvoyager.usercenter');
        $host=getConfigValue('zbasement.api.usercenter.host');

        $fetchUri=getConfigValue('zbasement.api.usercenter.api.store.uri');
        $action=getConfigValue('zbasement.api.usercenter.api.store.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $reponse=$this->connectWithAllResponse($action,$fetchUri,$data);
        if(isset($reponse)){
            if(isset($reponse->status)&&($reponse->status==false)){
                return false;
            }
            if(isset($reponse->data)){
                $this->fill($reponse->data[0]);
                return $this;
            }
        }


    }

    public function update(array $attributes = [], array $options = []){
//        $host=getConfigValue('zvoyager');
//        $host=getConfigValue('zvoyager.usercenter');
        $host=getConfigValue('zbasement.api.usercenter.host');

        $fetchUri=getConfigValue('zbasement.api.usercenter.api.update.uri');
        $action=getConfigValue('zbasement.api.usercenter.api.update.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $reponse=$this->connectWithAllResponse($action,$fetchUri,$attributes);
        if(isset($reponse)){
            if(isset($reponse->status)&&($reponse->status==false)){
                return false;
            }
            if(isset($reponse->data)){
                $this->fill($reponse->data[0]);
                return $this;
            }
        }
//        if(isset($data)){
//            $this->fill($data[0]);
//            return $this;
//        }

    }


    public function show($data){
//        $host=getConfigValue('zvoyager');
//        $host=getConfigValue('zvoyager.usercenter');
        $host=getConfigValue('zbasement.api.usercenter.host');

        $fetchUri=getConfigValue('zbasement.api.usercenter.api.show.uri').$data['uuid'];
        $action=getConfigValue('zbasement.api.usercenter.api.show.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $data=$this->connect($action,$fetchUri,$data);
        if(isset($data)){
            $this->fill($data[0]);
            return $this;
        }

    }

    public function index($parameters,$action=null,$fetchUri=null)
    {
        $host=getConfigValue('zbasement.api.usercenter.host');

        $fetchUri=getConfigValue('zbasement.api.usercenter.api.index.uri');
        $action=getConfigValue('zbasement.api.usercenter.api.index.action');
        $fetchUri=$host.$fetchUri;
        $result=parent::index($parameters,$action,$fetchUri);
        return $result;

    }

    public function transferKey($uuid){
        $host=getConfigValue('zbasement.api.usercenter.host');

        $fetchUri=getConfigValue('zbasement.api.usercenter.api.transferkey.uri');
        $action=getConfigValue('zbasement.api.usercenter.api.transferkey.action');
        $fetchUri=$host.$fetchUri;
//        $parameters=$data;
        $reponse=$this->connectWithAllResponse($action,$fetchUri,$uuid);
        if(isset($reponse)){
            if(isset($reponse->status)&&($reponse->status==false)){
                return false;
            }
            if(isset($reponse->data)){
                $this->fill($reponse->data[0]);
                return $this;
            }
        }

    }
}