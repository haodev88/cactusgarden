<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model {
	protected $table    = 'dt_customers';
    protected $guarded  = array('id');
    
    public function order() {
        return $this->hasMany('App\Models\Order','dt_customer_id');
    }

}
