<?php

namespace App\Http\Controllers\shop;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Order;
use App\cactus\Breadcrumb;
use URL;


class AccountController extends Controller
{
    public function Index() {
        return view("cactus.account.my-account");
    }

    public function Dashboard() {

        // breadcrumb
        $data["breadcrumb"]["title"] = "Bảng điều khiển";
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Bảng điều khiển'
            ]
        ];
        $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();

        return view("cactus.account.dashboard", $data);
    }

    public function MyOrder(Request $request) {

        $input  = $request->all();
        $info   = getUserInfo();
        $stt    = isset($input["page"]) ? ($input['page']-1)*Config("global.account_per_page") : 0;
        $data["orders"] = Order::getOrderwithEmail($info["email"])->paginate(Config("global.account_per_page"));
        $data["stt"]    = $stt;

        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Quản lý đơn hàng'
            ]
        ];
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        $data["breadcrumb"]["title"] = "Quản lý đơn hàng";

        return view("cactus.account.order-info", $data);
    }

    public function MyAccount() {
        $info = getUserInfo();
        $customer = Customer::find($info['id']);
        $data['province'] = Province::all();
        $data['info'] = $customer;
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Quản lý tài khoản'
            ]
        ];
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        $data["breadcrumb"]["title"] = "Quản lý tài khoản";

        return view("cactus.account.my-account", $data);
    }

    public function orderDetail($id) {
        $data["orderDetail"] = OrderDetail::where("dt_order_id", $id)->get();
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => Route("my_order"),
                'label' => 'Quản lý đơn hàng'
            ]
        ];
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        $data["breadcrumb"]["title"] = "Chi tiết đơn hàng";
        return view("cactus.account.order-detail", $data);
    }


    public function postMyaccount(Request $request) {
        $info = getUserInfo();
        if ($info!='') {
            $input = $request->all();
            $data= [
                'gender'    => $input['gender'],
                'name'      => $input['name'],
                'phone'     => $input['phone']
            ];
            if (!empty($input['password'])) {
                $data['password'] = bcrypt($input['password']);
            }
            $customer = Customer::find($info['id'])->update($data);
            if ($customer) {
                return Redirect()->route('my_account')->with('successMessage','Thông tin cá nhân của bạn đã được thay đổi');
            }
        }
    }

}
