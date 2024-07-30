<?php

namespace App\Http\Controllers\shop;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\cactus\Breadcrumb;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use URL;

class ProductController extends Controller {

    protected static $_CACHE_KEY_CATE = "CDP";

    public function getProduct($alias, Request $request) {
        if (Cache::has(self::$_CACHE_KEY_CATE.'_'.$alias)) {
            $data = Cache::get(self::$_CACHE_KEY_CATE.'_'.$alias);
        } else {
            $cate   = Category::select('id','title','slug')->where('slug',$alias)->first()->toArray();
            $append = [];
            if (!empty($cate)) {

                $priceFrom = $request->get("price_from", null);
                $priceTo = $request->get("price_to", null);
                $sortBy  = $request->get("sort_by", null);
                $shortValue = null;

                $sortOptions = $this->sortOptions();

                $product =  Product::select('id','name','slug','price','self_price','default_image','filename','short_desc')
                    ->where('dt_category_id',$cate['id']);

                if ($priceFrom != null) {
                    $product->where("price",">=",$priceFrom);
                    $append["price_from"] = $priceFrom;
                }

                if ($priceTo!=null) {
                    $product->where("price","<=",$priceTo);
                    $append["price_to"] = $priceTo;
                }

                if ($sortBy!=null) {
                    $shortValue = $sortOptions[$sortBy];
                    $sort = explode("_", $sortBy);
                    $product->orderBy($sort[0], $sort[1]);
                    $append["sort_by"] = $request->get("sort_by");
                } else {
                    $product->orderBy('id','DESC');
                }

                $product->where('active','=',1)
                    ->orderBy('id','DESC')
                    ->paginate(Config('global')['display_page']);
                $listProduct = $product->paginate(Config('global')['display_page']);
                $discountProduct = Product::select('name','default_image','price','self_price')->where('self_price',"!=", 0)->limit(5)->get();
                $blog = Blog::where("id","!=",1)->select("id","title","image","slug","image","author")->where("active",1)->limit(5)->orderBy("updated_at", "DESC")->get();

                $data["blog"] = $blog;
                $data["discountProduct"] = $discountProduct;
                $data["sortOptions"]  = $sortOptions;
                $data["sortValue"]    = $shortValue;
                $data["sortAction"]   = Route('product',['alias'=>$alias]);
                $data["cate"]         = $cate;
                $data["alias"]        = $alias;
                $data["listProduct"]  = $listProduct;
                $data["append"]       = $append;

                $data["params"] = $request->all();

                // breadcrumb
                $data["breadcrumb"]["title"] = $cate["title"];
                $data["breadcrumb"]["items"] = [
                    [
                        'url'   => URL::to('/'),
                        'label' => 'Trang chủ'
                    ],
                    [
                        'url'   => '',
                        'label' => 'Sản phẩm'
                    ]
                ];
                $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();
                Cache::put(self::$_CACHE_KEY_CATE.'_'.$alias, $data, env("TIME_CACHE"));
            }
        }
        return view('cactus.cdp', $data);

    }

    /*
    public function cdp(Request $request) {

        $append = [];
        $priceFrom   = $request->get("price_from", null);
        $priceTo     = $request->get("price_to", null);
        $sortBy      = $request->get("sort_by", null);
        $shortValue = null;

        $product = Product::select('id','name','slug','price','self_price','default_image','filename','short_desc')
            ->where('active','=',1);

        $sortOptions = $this->sortOptions();

        if ($priceFrom != null) {
            $product->where("price",">=",$priceFrom);
            $append["price_from"] = $priceFrom;
        }

        if ($priceTo!=null) {
            $product->where("price","<=",$priceTo);
            $append["price_to"] = $priceTo;
        }

        if ($sortBy!=null) {
            $shortValue = $sortOptions[$sortBy];
            $sort = explode("_", $sortBy);
            $product->orderBy($sort[0], $sort[1]);
        } else {
            $product->orderBy('id','DESC');
        }

        $listProduct = $product->paginate(Config('global')['display_page']);
        $discountProduct = Product::select('name','default_image','price','self_price')->where('self_price',"!=", 0)->limit(2)->get();

        $data["sortValue"]       = $shortValue;
        $data["sortAction"]      = Route('cdp');
        $data["append"]          = $append;
        $data["discountProduct"] = $discountProduct;
        $data["listProduct"] = $listProduct;
        $data["sortOptions"] = $sortOptions;
        $data["params"]      = $request->all();

        // breadcrumb
        $data["breadcrumb"]["title"] = "Sản phẩm";
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Sản phẩm'
            ]
        ];
        $data["breadcrumb"]["bg"] = $this->getBreadcrumbBg();

        return view('cactus.cdp', $data);
    }
    */

    protected function sortOptions() {
        $data = [
            "name_asc"   => "Tên, A to Z",
            "name_desc"  => "Tên, Z to A",
            "price_asc"  => "Giá, Thấp đến cao",
            "price_desc" => "Giá, cao đến thấp"
        ];
        return $data;
    }


}
