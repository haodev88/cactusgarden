<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;


class AjaxRequestController extends Controller {
   	/**
   	 * [getBrand from ajax with supplier id]
   	 * @return [Json]
   	 */
   	public function getBrand(Request $request) {
        if ($request->ajax()) {
       		$input = $request->all();
       		if (isset($input['supplierId'])) {
       			$supplierId = $input['supplierId'];
       			$supplier   = Supplier::where("id","=",$supplierId);
    			$dataBrand  = $supplier->with(['brand'=>function($query) {
    				$query->select('id', 'name');
    			}])->first()->toArray();
    			if (!empty($dataBrand['brand'])) {
    				return response()->json($dataBrand['brand']);
    			} else {
    				return null;
    			}
       		}
        }
   	}

    /**
     * [checkSku from ajax]
     * @return [true,false] [exists=>true]
     */
    public function checkSku(Request $request) {
        if ($request->ajax()) {
            $txtSku  	= $request->input('txtSku');
            $productId	= $request->input('productId');
            if ($productId != "") {
            	$res = Product::where('sku','=',$txtSku)->where('id','!=',$productId)->count();
            } else {
            	$res = Product::where('sku','=',$txtSku)->count();
            }
            if ($res == 1) {
                echo true;
            } else {
                echo false;
            }
        }
    }

	/**
	 * [get District]
	 */
	public function getDistrict(Request $request) {
		if ($request->ajax()) {
			$input    = $request->all();
			$district = District::select('districtid','name','type')->where('provinceid',$input['id'])->get()->toJson();
			return $district;
		}
	}

	public function getWard(Request $request) {
		if ($request->ajax()) {
			$input    = $request->all();
			$ward     = Ward::select('wardid','name','type')->where('districtid',$input['id'])->get()->toJson();
			return $ward;
		}
	}

	public function saveOrderStatus(Request $request) {
		$html_tracking = '';
		if ($request->ajax()) {
			$status  = $request->get('status');
			$orderId = $request->get('orderId');
			$order 		   = Order::findorFail($orderId);
			if ($order) {
				$order->update([
					'dt_order_status_id' => $status
				]);
				$orderStatus = Order::with(['orderStatus'=>function($query){
					$query->select('id','html_tracking');
				}])->find($orderId)->toArray();
				$html_tracking = $orderStatus['order_status']['html_tracking'];
			}
			return response()->json([
				'status' 		=> 1,
				'html_tracking' => $html_tracking
			]);
		} else {
			return response()->json([
				'status' => 0,
				'html_tracking' => $html_tracking
			]);
		}
	}


}
