<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {
    
    protected $table    = 'dt_banners';
    protected $guarded  = [];

    public function bannerPosition() {
        return $this->belongsTo('App\Models\BannerPosition','banner_position_id');
    }

}
