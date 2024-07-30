<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table    = 'dt_products';
    protected $guarded  = [];

     /**
     * Relation to category table.
     * @return [type] [description]
     */
    public function category() {
    	return $this->belongsTo('App\Models\Category','dt_category_id');
    }

     /**
     * Relation to brand table.
     * @return [type] [description]
     */
    public function brand() {
    	return $this->belongsTo('App\Models\Brand','dt_brand_id');
    }

     /**
     * Relation to Supplier table.
     * @return [type] [description]
     */
    public function supplier() {
    	return $this->belongsTo('App\Models\Supplier','dt_supplier_id');
    }

    /**
     *  Relation to Option table.
     */
    public function option() {
        return $this->belongsToMany('App\Models\Option','dt_product_options','dt_product_id','dt_option_id');
    }

}
