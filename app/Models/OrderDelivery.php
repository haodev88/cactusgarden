<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model {
    protected $table    = 'dt_order_delivery';
    protected $guarded  = [];
    public $timestamps  = false;

    public function order() {
        return $this->belongsTo('App\Models\Order','dt_order_id');
    }

}
