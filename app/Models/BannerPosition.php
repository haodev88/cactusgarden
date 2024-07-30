<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPosition extends Model {
    protected $table    = 'dt_banner_positions';
    protected $guarded  = [];

    public function banner() {
        return $this->hasMany('App\Models\Banner','banner_position_id');
    }

}
