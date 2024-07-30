<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
    
    protected $table    = 'dt_brands';
    protected $guarded  = [];


    public function brandProduct() {
    	return $this->hasMany('App\Models\Product','dt_brand_id');
    }

    public function supplier() {
    	return $this->belongsToMany('App\Models\Supplier','dt_supplier_brand_buyer','dt_supplier_id','dt_brand_id','dt_buyer_id');
    }


}
