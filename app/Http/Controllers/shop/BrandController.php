<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function getBrand($slug) {
        $data['showPrice']   = true;

        $data["leftBrand"] = DB::table("dt_products as p")
            ->select("b.name as brand_name","b.slug","p.dt_brand_id",DB::raw('COUNT(p.dt_brand_id) as total_product'))
            ->leftJoin("dt_brands as b","b.id","=","p.dt_brand_id")
            ->where("b.slug",'!=',$slug)
            ->groupBy("p.dt_brand_id")
            ->get();

        $data['listProduct'] = DB::table('dt_products as p')
            ->select('p.id','p.name','p.slug','p.price','p.self_price','p.default_image','b.name as brand_name')
            ->leftJoin("dt_brands as b","b.id","=","p.dt_brand_id")
            ->where('b.slug','=',$slug)
            ->paginate(Config('global')['display_page']);
        return view('shop.brand.get-brand',$data);
    }
}
