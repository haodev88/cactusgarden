<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model {
    protected $table    = 'dt_order_status';
    protected $guarded  = [];

    public function order() {
        return $this->hasMany('App\Models\Order','dt_order_status_id');
    }
}
