<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\cactus\Breadcrumb;
use URL;

class ShoppingController extends Controller {

    public function add(Request $request) {
        $input = $request->all();
        $data  = [];
        if (isset($input['id']) && $input['id']!='') {
            $id   = (INT)$input['id'];
            $p = Product::select('id','name','price','self_price','default_image','slug','dt_brand_id','sku','dt_supplier_id')->where('count','>',0)->with(['brand'=>function($q) {
                $q->select('id','name');
            }])->find($id)->toArray();

            if (!empty($p)) {
                if ($request->session()->has('shoppingcart')) {
                    $cart   = $request->session()->get('shoppingcart');
                    $cart   = json_decode($cart,true);
                    $exists = false;
                    foreach ($cart as $key=>$item) {
                        if (($item['id'] == $p['id']) && ($item['color'] == $input['sltColor']) && ($item['size'] == $input['sltSize'])) {
                            $maxValue = config('global.max_value');
                            $q = $cart[$key]['quanlity']+$input['number'];
                            if ($q >  $maxValue) { $q = $maxValue;}
                            $cart[$key]['quanlity'] = $q;
                            $exists = true;
                            break;
                        }
                    }
                    if (!$exists) {
                        $p['quanlity']   = $input['number'];
                        $p['size']       = isset($input['sltSize']) &&  ($input['sltSize']!='') ? $input['size'] : '';
                        $p['color']      = isset($input['sltColor']) && ($input['sltColor']!='') ? $input['sltColor'] : '';
                        $p['brand_id']   = $p['brand']['id'];
                        $p['brand_name'] = $p['brand']['name'];
                        $p['price'] = ($p['self_price']!=0) ? $p['self_price'] : $p['price'];
                        unset($p['brand']);
                        array_push($cart,$p);
                    }
                    $cart = json_encode($cart);
                    $request->session()->put('shoppingcart', $cart);
                    return Response()->Json($cart);
                } else {
                    $p['quanlity']   = $input['number'];
                    $p['color']      = isset($input['sltColor']) && ($input['sltColor']!='') ? $input['sltColor'] : '';
                    $p['size']       = isset($input['sltSize']) &&  ($input['sltSize']!='') ? $input['size'] : '';
                    $p['brand_id']   = $p['brand']['id'];
                    $p['brand_name'] = $p['brand']['name'];
                    $p['price'] = ($p['self_price']!=0) ? $p['self_price'] : $p['price'];
                    unset($p['brand']);
                    array_push($data,$p);
                    $data = json_encode($data);
                    $request->session()->put('shoppingcart', $data);
                    return Response()->Json($data);
                }
            } else {
                return Response()->Json(['error'=>'empty']);
            }
        }
    }


    public function update(Request $request) {
        $input  = $request->all();
        $cart   = $request->session()->get('shoppingcart');
        $t= $totalItem = $dem = 0;
        $putCart = $returnData = $outPut =[];
        if ($cart!='') {
            $cart   = json_decode($cart,true);
            if (isset($input['keyCart']) && isset($input['id'])) {
                $id = (INT)$input['id'];
                $key = $input['keyCart'];
                if (array_key_exists($key,$cart)) {
                    $qty = (INT)$input['qty'];
                    if ($qty < 0) {
                        $qty = 1;
                    } if ($qty > config('global.max_value')) {
                        $qty = config('global.max_value');
                    }
                    $p   = Product::select('id')->where('count','>',$qty)->find($id);
                    if ($p) { $cart[$key]['quanlity'] = $qty; }
                    foreach ($cart as $key=>$item) {
                        $total     = ($item['quanlity']*$item['price']);
                        $t+=$total;
                        $img = sizeOfFileName(asset('uploads/mains/'.$item["default_image"]),'80x80');
                        $putCart[$dem] = $item;
                        $totalItem+=$item['quanlity'];
                        $outPut[$dem] = $item;
                        $outPut[$dem]['default_image'] = $img['path'].$img['filename'];
                        $outPut[$dem]['total_price']   = currentPriceFormat($item['quanlity']*$item['price']);
                        $outPut[$dem]['price']         = currentPriceFormat($item['price']);
                        $dem++;
                    }
                }
                $cart_encode = json_encode($putCart);
                $request->session()->put('shoppingcart',$cart_encode);
                $returnData = [
                    'subTotal'   => currentPriceFormat($t),
                    'cart'       => $outPut,
                    'csrfToken'  => csrf_token(),
                    'formAction' => route('update-cart'),
                    'totalItem'  => $totalItem
                ];
            }
        }
        return Response()->Json($returnData);
    }

    public function get(Request $request) {
        $data = [];
        if ($request->session()->has('shoppingcart')) {
            $cart = $request->session()->get('shoppingcart');
            $cart = json_decode($cart,true);
            $data['listCart'] = $cart;
        }

        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Giỏ hàng'
            ]
        ];
        $data["breadcrumb"]["title"] = "Giỏ hàng của bạn";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();

        return view('cactus.view-cart', $data);
    }


    public function delete(Request $request) {
        $input = $request->all();
        $key   = $input['key'];
        $dem = $totalItem = $t= 0;
        $putCart =$outPut=$data_return = [];

        if ($request->session()->has('shoppingcart')) {
            $cart = $request->session()->get('shoppingcart');
            $cart = json_decode($cart,true);
            if (array_key_exists($key,$cart)) {
                unset($cart[$key]);
                foreach ($cart as $item) {
                    $total     = ($item['quanlity']*$item['price']);
                    $t+=$total;
                    $img = sizeOfFileName(asset('uploads/mains/'.$item["default_image"]),'80x80');
                    $putCart[$dem] = $item;
                    $totalItem+=$item['quanlity'];
                    $outPut[$dem] = $item;
                    $outPut[$dem]['default_image'] = $img['path'].$img['filename'];
                    $outPut[$dem]['total_price']   = currentPriceFormat($item['quanlity']*$item['price']);
                    $outPut[$dem]['price']         = currentPriceFormat($item['price']);
                    $dem++;
                }
            }

            if (!empty($putCart)) {
                $putCart = json_encode($putCart);
                $request->session()->put('shoppingcart',$putCart);
                $data_return=[
                    'subTotal'   => currentPriceFormat($t),
                    'cart'       => $outPut,
                    'csrfToken'  => csrf_token(),
                    'totalItem'  => $totalItem
                ];
            } else {
                $request->session()->forget('shoppingcart');

            }
        }
        return Response()->json($data_return);
    }


    public function clear(Request $request) {
        $request->session()->forget('shoppingcart');
        return redirect()->route('get-cart');
    }

}
