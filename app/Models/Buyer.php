<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model {
	protected $table    = 'dt_buyers';
    protected $guarded  = [];

    public function supplier() {
    	return $this->hasMany('App\Models\Supplier','dt_buyer_id');
    }
}
