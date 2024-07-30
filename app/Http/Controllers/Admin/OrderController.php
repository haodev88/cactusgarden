<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDelivery;
use App\Models\Province;
use App\Models\Ward;
use App\Models\District;
use App\Models\OrderStatus;
use App\Models\Product;
use DB;

class OrderController extends Controller {

    private $_rowperpage;

    public function __construct() {
        $this->_rowperpage = config('global.row_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $data['stt'] = $stt;
        $data['listOrder'] = Order::orderBy('id','DESC')->paginate($this->_rowperpage);
        $data['isIndex'] = true;
        return view('cms.order.list', $data);
    }

    public function search(Request $request) {
        $input = $request->all();
        $order = DB::table('dt_orders')->select(
            'dt_orders.id',
            'dt_orders.order_code',
            'dt_order_delivery.name_delivery_from',
            'dt_order_delivery.phone_delivery_from',
            'dt_order_delivery.order_email',
            'dt_orders.created_at'
        );
        $order->leftJoin('dt_order_details','dt_orders.id','=','dt_order_details.dt_order_id');
        $order->leftJoin('dt_order_delivery','dt_orders.id','=','dt_order_delivery.dt_order_id');
        if (isset($input['ordercode']) && $input['ordercode']!='') {
            $order->where('dt_orders.order_code','LIKE','%'.$input['ordercode'].'%');
            $data['append']['ordercode'] = $input['ordercode'];
        }
        if (isset($input['name']) && $input['name']!='') {
            $order->where('dt_order_delivery.name_delivery_from','LIKE','%'.$input['name'].'%');
            $data['append']['name'] = $input['name'];
        }
        if (isset($input['email']) && $input['email']!='') {
            $order->where('dt_order_delivery.order_email','LIKE','%'.$input['email'].'%');
            $data['append']['email'] = $input['email'];
        }
        if (isset($input['phone']) && $input['phone']!='') {
            $order->where('dt_order_delivery.phone_delivery_from','LIKE','%'.$input['phone'].'%');
            $data['append']['phone'] = $input['phone'];
        }
        if (isset($input['date']) && $input['date']!='') {
            $date = date("Y-m-d",strtotime(str_replace('/','-',$input['date'])));
            $order->whereRaw(DB::raw('DATE_FORMAT(dt_orders.created_at,"%Y-%m-%d") = "'.$date.'"'));
            $data['append']['date'] = $input['date'];
        }
        $data['listOrder'] = $order->orderBy('dt_orders.id','DESC')->paginate($this->_rowperpage);
        return view('cms.order.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $order                  = Order::with('orderDelivery','orderDetail','customer','orderStatus')->find($id)->toArray();
        $data['orderStatus']    = OrderStatus::all()->toArray();
        $data['districtTo']     = District::where('provinceid',$order['order_delivery']['dt_provinceid_to'])->get()->toArray();
        $data['wardTo']         = Ward::where('districtid',$order['order_delivery']['dt_districtid_to'])->get()->toArray();
        $data['province']       = Province::all()->toArray();
        $data['districtFrom']   = District::where('provinceid',$order['order_delivery']['dt_provinceid_from'])->get()->toArray();
        $data['wardFrom']       = Ward::where('districtid',$order['order_delivery']['dt_districtid_from'])->get()->toArray();
        $data['order']          = $order;
        return view('cms.order.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/** --------------------------- AJAX ORDER --------------------------------- **/

    public function changeOrderInfo(Request $request) {
        if ($request->ajax()) {
            $input  = $request->all();
            Order::find($input['order_id'])->update([
                'order_note' => $input['orderNote']
            ]);
            OrderDelivery::where('dt_order_id',$input['order_id'])->update([
                'name_delivery_from'    =>  $input['txtNameFrom'],
                'phone_delivery_from'   =>  $input['txtPhoneFrom'],
                'order_email'           =>  $input['txtEmailFrom'],
                'dt_provinceid_from'    =>  $input['sltCityFrom'],
                'dt_districtid_from'    =>  $input['sltDistrictFrom'],
                'dt_wardid_from'        =>  $input['sltWardFrom'],
                'address_from'          =>  $input['txtAddressFrom'],
                'name_delivery_to'      =>  $input['txtNameTo'],
                'phone_delivery_to'     =>  $input['txtPhoneTo'],
                'dt_provinceid_to'      =>  $input['sltCityTo'],
                'dt_districtid_to'      =>  $input['sltDistrictTo'],
                'dt_wardid_to'          =>  $input['sltWardTo'],
                'address_to'            =>  $input['txtAddressTo']
            ]);
            return response()->json([
                'status' =>  1,
                'mess'   =>  'Thông tin giao hàng được cập nhật'
            ]);
        } else {
            return response()->json([
                'status' =>  1,
                'mess'   =>  'Request không hợp lệ'
            ]);
        }
    }

    public function addOrderProduct(Request $request) {
        if ($request->ajax()) {
            $input     = $request->all();
            $p = Product::where('sku', $input['txtSku'])->where('count', '>', $input['txtQuanlity'])->first();
            if ($p == '') {
                return response()->json([
                    'status' =>  0,
                    'mess'   =>  'SKU không tồn tại hoặc số lượng không đủ'
                ]);
            } else {
                $attribute = '';
                if (isset($input['sltGroup']) && !empty($input['sltGroup'])) {
                    $attribute = implode(', ', $input['sltGroup']);
                }
                $p = $p->toArray();
                OrderDetail::create([
                    'dt_order_id'       =>   $input['orderId'],
                    'dt_brand_id'       =>   $p['dt_brand_id'],
                    'dt_supplier_id'    =>   $p['dt_supplier_id'],
                    'dt_product_id'     =>   $p['id'],
                    'sku'               =>   $p['sku'],
                    'product_name'      =>   $p['name'],
                    'quanlity'          =>   $input['txtQuanlity'],
                    'price'             =>   $p['price'],
                    'attribute'         =>   $attribute
                ]);
                return response()->json([
                    'status' =>  1,
                    'mess'   =>  'Sản phẩm được thêm thành công'
                ]);
            }
        }
    }


    public function chooseAtrribuite(Request $request) {
        if ($request->ajax()) {
            $sku    = $request->get('sku');
            $option = getOptionProduct($sku);
            $html   = '';
            if ($option!='') {
                foreach ($option as $group=>$val) {
                    $html.='<div class="form-group" id="product_option">';
                    $html.='<label class="col-sm-3 control-label">'.$group.'</label>';
                    $html.='<div class="col-sm-9">';
                    $html.='<select name="sltGroup[]" id="sltGroup" class="form-control select2_single">';
                    foreach ($val as $option) {
                        $html.='<option value="'.$option['name'].'">'.$option['name'].'</option>';
                    }
                    $html.='</select>';
                    $html.='</div>';
                    $html.='</div>';
                }
            }
            return $html;
        }
    }

    public function editQuanlity(Request $request) {
        $input = $request->all();
        if ($request->ajax()) {
            OrderDetail::find($input['id'])->update([
                'quanlity'  =>  $input['quanlity']
            ]);
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0,'mess'=>'request không hợp lệ']);
        }
    }

    public function deleteItem(Request $request) {
        if ($request->ajax()) {
            $id = $request->get('id');
            $orderDetail = OrderDetail::findorFail($id);
            if ($orderDetail) {
                $orderDetail->delete();
            }
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0,'mess'=>'request không hợp lệ']);
        }
    }


}
