<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionAction extends Model {
	protected $table    = 'permission_actions';
    protected $guarded  = [];

    public function Permission() {
    	return $this->belongsTo('App\Models\Permission','permission_id');
    }

}
