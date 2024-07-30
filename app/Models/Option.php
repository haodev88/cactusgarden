<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {
    protected $table    = 'dt_options';
    protected $guarded  = [];
    
    /**
     * Relationship with option
     * @return [type] [description]
     */
    public function optionGroup() {	
    	return $this->belongsTo('App\Models\OptionGroup','dt_option_group_id');
    }

    /**
    * Relationship with Product Table
    */
    public function product() {
    	return $this->belongsToMany('App\Models\Product','dt_product_options','dt_product_id','dt_option_id');
    }
    
}
