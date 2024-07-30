<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\cactus\Breadcrumb;
use URL;

class SearchController extends Controller {

    public function get(Request $requests) {
        $shortValue = null;
        $input   = $requests->all();
        $sortBy  = $requests->get("sort_by", null);
        $sortOptions = $this->sortOptions();

        if (isset($input['tu-khoa']) && !empty($input['tu-khoa'])) {

            $data['append'] = [
                'tu-khoa'=>$input['tu-khoa']
            ];

            $listProducts = Product::select('id','name','slug','price','self_price','default_image','filename')
                ->where('name','LIKE','%'.$input['tu-khoa'].'%')
                ->where('active','=',1);

            if ($sortBy!=null) {
                $shortValue = $sortOptions[$sortBy];
                $sort = explode("_", $sortBy);
                $listProducts->orderBy($sort[0], $sort[1]);
                $data['append']['sort_by'] = $requests->get("sort_by");
            }
            $listProducts = $listProducts->paginate(Config('global')['display_page']);
            $data["listProduct"] = $listProducts;
            $data['keyword'] = $input['tu-khoa'];
        } else {
            return Redirect()->route('home');
        }

        $data["sortAction"]   = Route('search-product');
        $data["sortOptions"]  = $sortOptions;
        $data["sortValue"]    = $shortValue;

        // breadcrumb
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Tìm kiếm sản phẩm'
            ]
        ];
        $data["breadcrumb"]["title"] = $input['tu-khoa'];
        $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();

        return view('cactus.search',$data);
    }

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
