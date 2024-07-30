<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeautureController extends Model {
	
	protected $table    = 'controllers';
    protected $guarded  = [];
    public $timestamps  = false;


    public function action() {
    	return $this->hasMany('App\Models\FeautureAction','controller_id');
    }

    public function user() {
    	return $this->belongsToMany('App\Models\User','user_controller_action','controller_id');
    }


   
}
