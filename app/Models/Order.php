<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model {
    protected $table    = 'dt_orders';
    protected $guarded  = [];

    public function orderDetail() {
        return $this->hasMany('App\Models\OrderDetail','dt_order_id');
    }

    public function orderDelivery() {
        return $this->hasOne('App\Models\OrderDelivery','dt_order_id');
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer','dt_customer_id')->select('id','email','name','phone');
    }

    public function orderStatus() {
        return $this->belongsTo('App\Models\OrderStatus','dt_order_status_id');
    }


    public static function getOrderwithEmail($email) {
        return DB::table("dt_order_delivery AS order_delivery")
            ->select(["order_delivery.order_email","order.created_at","order.total_amount","order.id","order_status.name","order.order_code"])
            ->join("dt_orders AS order", "order_delivery.dt_order_id","=","order.id")
            ->join("dt_order_status AS order_status", "order.dt_order_status_id","=","order_status.id")
            ->where("order_delivery.order_email", $email);
    }
}
