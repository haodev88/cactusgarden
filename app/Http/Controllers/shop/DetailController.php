<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\cactus\Breadcrumb;
use Illuminate\Support\Facades\Cache;
use URL;

class DetailController extends Controller {

    protected static $_CACHE_KEY_DETAIL="DETAIL_PAGE";

    public function getItem($alias,$id) {
        if(Cache::has(self::$_CACHE_KEY_DETAIL.'_'.$id)) {
            $data = Cache::get(self::$_CACHE_KEY_DETAIL.'_'.$id);
        } else {
            $p    = Product::where("id","=",$id)->first();
            $data = [];
            if ($p) {

                $data['ProductSameCate'] = Product::select("id","name","slug","price","self_price","default_image","count","filename","short_desc")->where('dt_category_id',$p->dt_category_id)
                    ->where('id','!=',$id)
                    ->where('active','=',1)
                    ->orderby('id','DESC')
                    ->limit(12)
                    ->get();

                $data["itemProduct"] = $p;

                // breadcrumb
                $data["breadcrumb"]["title"] = $p['name'];
                $data["breadcrumb"]["items"] = [
                    [
                        'url'   => URL::to('/'),
                        'label' => 'Trang chủ'
                    ],
                    [
                        'url'   => '',
                        'label' => 'Chi tiết'
                    ]
                ];
                $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();
                Cache::put(self::$_CACHE_KEY_DETAIL.'_'.$id, $data, env("TIME_CACHE",1440));
            }
        }

        return view("cactus.pdp",$data);
    }



}
