<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    public function group() {
        return $this->belongsToMany('App\Models\UserGroup','user_group_merge','user_id','user_group_id');
    }

    public function userController() {
        return $this->belongsToMany('App\Models\FeautureController','user_controller_action','user_id','controller_id');
    }

    public function userAction() {
        return $this->belongsToMany('App\Models\FeautureAction','user_controller_action','user_id','action_id');
    }

}
