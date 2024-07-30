<?php

namespace App\Http\Controllers\shop;
use Mail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Ward;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\District;
use App\Http\Requests\shop\InfomationRequest;
use DateTime;
use App\Models\OrderDelivery;
use App\Models\Order;
use App\cactus\Breadcrumb;
use Illuminate\Http\Request;
use App\Http\Requests\shop\OrderRequest;
use URL;

class OrderController extends Controller {

    public function infomation() {
        $data['province'] = Province::all();
        $data['district'] = District::where('provinceid','=',79)->orderby('name')->get();
        $data['ward']     = Ward::where('districtid','=',774)->orderby('name')->get();
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Thông tin giao hàng'
            ]
        ];
        $data["breadcrumb"]["title"] = "Thông tin giao hàng";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        return view('cactus.order',$data);
    }

    public function postInfomation(OrderRequest $request) {
        $input = $request->all();

        if ($request->session()->has('shoppingcart')) {
            // order detail
            $cart = $request->session()->get('shoppingcart');
            $cart = json_decode($cart,true);
            $dataInsert  = [];
            $totalAmount = 0;
            $dataEmpty   = [];
            foreach ($cart as $key=>$item) {
                $coutproduct = Product::select(DB::raw('count(id) as total'))->where('id','=',$item['id'])->where('count','>=',$item['quanlity'])->first()->toArray()['total'];
                if ($coutproduct > 0) {
                    $price = $item['self_price']!=0 ? $item['self_price'] : $item['price'];
                    $totalAmount+= $price*$item['quanlity'];
                    $attr  = '';
                    if ($item['color']!='') { $attr.= $item['color']; }
                    if ($item['size']!='')  { $attr.= ' |'.$item['size'];}
                    $dataInsert[] = [
                        'dt_brand_id'       => $item['brand_id'],
                        'dt_supplier_id'    => $item['dt_supplier_id'],
                        'dt_product_id'     => $item['id'],
                        'sku'               => $item['sku'],
                        'price'             => $price,
                        'product_name'      => $item['name'],
                        'quanlity'          => $item['quanlity'],
                        'attribute'         => $attr,
                    ];
                } else {
                    $dataEmpty[] = $cart[$key];
                }
            }
            // insert order
            if (!empty($dataInsert)) {
                $userInfo   = getUserInfo();
                $customerId = (is_array($userInfo)) ? $userInfo['id'] : 0;
                $orderCode  = date("YmdHsi");
                $orderId    = DB::table('dt_orders')->insertGetId([
                    'dt_customer_id' => $customerId,
                    'dt_order_status_id'=>1,
                    'order_code'     => $orderCode,
                    'order_note'     => $input['params']['note'],
                    'fee_shipping'   => 0,
                    'total_amount'  => $totalAmount,
                    'created_at'    => new DateTime(),
                    'updated_at'    => new DateTime()
                ]);
                // order delivery
                $dataDelivery = [
                    'dt_order_id'           => $orderId,
                    'name_delivery_from'    => $input['orderer_name'],
                    'order_email'           => $input['orderer_email'],
                    'phone_delivery_from'   => $input['orderer_phone'],
                    'dt_provinceid_from'    => $input['dd_province'],
                    'dt_districtid_from'    => $input['dd_district'],
                    'dt_wardid_from'        => $input['dd_ward'],
                    'address_from'          => $input['orderer_address'],
                    'name_delivery_to'      => $input['orderer_name'],
                    'phone_delivery_to'     => $input['orderer_phone'],
                    'dt_provinceid_to'      => $input['dd_province'],
                    'dt_districtid_to'      => $input['dd_district'],
                    'dt_wardid_to'          => $input['dd_ward'],
                    'address_to'            => $input['orderer_address'],
                ];
                OrderDelivery::create($dataDelivery);
                // insert order detail
                for ($i=0;$i<count($dataInsert);$i++) {
                    $dataInsert[$i]['dt_order_id'] = $orderId;
                }                
                $create = DB::table('dt_order_details')->insert($dataInsert);
                // send email order
                /*
                if ($create) {
                    $orderInfo = Order::where('order_code','=',$orderCode)->first();
                    Mail::send('template-email.email-order', ['orderInfo' => $orderInfo], function($message) use ($orderInfo) {
                        $message->to($orderInfo->orderDelivery->order_email);
                        $message->subject('Thông Tin Đơn Hàng');
                    });
                }
                */
                
            } else {
                echo "Sản phẩm bạn đặt vừa hết hàng";
                die();
            }
            $request->session()->forget('shoppingcart');
            $data["breadcrumb"]["items"] = [
                [
                    'url'   => URL::to('/'),
                    'label' => 'Trang chủ'
                ],
                [
                    'url'   => '',
                    'label' => 'Đặt hàng'
                ]
            ];
            $data["breadcrumb"]["title"] = "Đặt hàng thành công";
            $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();


            $data['orderCode'] = $orderCode;
            return view("cactus.order-success", $data);
        } else {
            return Redirect()->route('view-cart');
        }
    }

    public function success() {
        return view('shop.order.success');
    }

}
