<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    
    protected $table    = 'dt_suppliers';
    protected $guarded  = [];

    /**
     * relationship with product table
     * @return [type] [description]
     */
    public function supplierProduct() {
    	return $this->hasMany('App\Models\Product','dt_supplier_id');
    }
    /** 
     * Many to many dt_supplier_brand
     * @return [type] [description]
     */
    public function brand() {
    	return $this->belongsToMany('App\Models\Brand','dt_supplier_brand_buyer','dt_supplier_id','dt_brand_id','dt_buyer_id');
    }

    public function buyer() {
        return $this->belongsTo('App\Models\Buyer','dt_buyer_id');
    }


}
