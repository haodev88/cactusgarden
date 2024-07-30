<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {
    protected $table    = 'dt_order_details';
    protected $guarded  = [];
  

    public function order() {
        return $this->belongsTo('App\Models\Order','dt_order_id');
    }


    
}
