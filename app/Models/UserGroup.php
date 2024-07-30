<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {
	protected $table = 'user_groups';
	protected $guarded  = [];

	public function user() {
        return $this->belongsToMany('App\Models\User','user_group_merge','user_id','user_group_id');
    }

}
