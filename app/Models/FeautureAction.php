<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeautureAction extends Model {
    protected $table    = 'actions';
    protected $guarded  = [];
    public $timestamps  = false;

    public function fnController() {
    	return $this->belongsTo('App\Models\FeautureController','controller_id');
    }

}
