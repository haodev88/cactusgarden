<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model {
	protected $table    = 'dt_option_groups';
    protected $guarded  = [];


    /**
     * Relation with option model
     * @return [type] [description]
     */
    public function option() {
    	return $this->hasMany('App\Models\Option','dt_option_group_id')->select(['dt_option_group_id','id as option_id','name']);
    }

}
