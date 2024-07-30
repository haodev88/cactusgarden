<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $table    = 'dt_categorys';
    protected $guarded  = [];

    /**
     * Relation to products table.
     * @return [type] [description]
     */
    public function categoryProduct() {
    	return $this->hasMany('App\Models\Product','dt_category_id');
    }

}
