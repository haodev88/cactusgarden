<?php

namespace App\Http\Controllers\shop;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\shop\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\cactus\Breadcrumb;
use URL;

class AuthController extends Controller {

    public function getRegister() {

        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Thành viên'
            ]
        ];
        $data["breadcrumb"]["title"] = "Đăng ký thành viên";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();

        return view('cactus.register', $data);
    }

    public function postRegister(RegisterRequest $request) {
        $input = $request->all();
        Customer::create([
            'name'      => $input['name'],
            'email'     => $input['email'],
            'password'  => bcrypt($input['password']),
            'gender'    => $input['gender']
        ]);
        return redirect()->route("get-login")->with("successMessage", "Tài khoản của bạn đã đăng ký thành công.");
    }

    public function getLogin() {
        if (getUserInfo()!='') return Redirect()->route('home');
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Thành viên'
            ]
        ];
        $data["breadcrumb"]["title"] = "Đăng ký thành viên";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        return view('cactus.login', $data);
    }

    public function postLogin(Request $request) {
        $input    = $request->all();
        $customer = Customer::select('id','email','name','password')->where('email','=',$input['email'])->first();
        if ($customer) {
            if (Hash::check($input['password'],$customer->password)) {
                unset($customer->password);
                $customer = json_encode($customer->toArray());
                $request->session()->put('USERINFO', $customer);
                return Redirect()->route('my_account');
            } else {
                return Redirect()->route('get-login')->with('Error','Thông tin đăng nhập không chính xác !');
            }
        } else {
            return Redirect()->route('get-login')->with('Error','Thông tin đăng nhập không chính xác !');
        }

    }

    public function logout(Request $request) {
        $request->session()->forget('USERINFO');
        return Redirect()->route('get-login');
    }


    public function getPassword() {
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => Route("get-login"),
                'label' => 'Đăng nhập'
            ]
        ];
        $data["breadcrumb"]["title"] = "Quên mật khẩu";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        return view('cactus.lost-pass', $data);
    }

    public function postPassword(Request $request) {
        if ($request->session()->get("is_submit_post_pass",0) == 1) {
           return redirect()->route("get-login");
        }
        $input      = $request->all();
        $email      = $input['email'];
        $findInfo   = Customer::select('id','name','email')->where('email',$email)->first();
        if ($findInfo) {
            $findInfo  = $findInfo->toArray();
            $checkSum  = bcrypt($findInfo["email"]);
            // update check_sum
            Customer::where('email','=',$findInfo["email"])->update(['check_sum'=>$checkSum]);
            $findInfo['checkSum'] = $checkSum;
            // send email
            Mail::send('template-email.cactus-forget', ['findInfo' => $findInfo], function($message) use ($findInfo) {
                $message->to($findInfo["email"]);
                $message->subject('Lấy lại mật khẩu');
            });
            $data['text'] =
            '<p class="alert alert-success">Thông tin đã được gửi qua hộp thư mail của bạn <br />
                nếu cần sự trợ giúp vui lòng liên hệ theo hotline <strong>'.Config('global')['infomation_shop']['hotline'].'</strong> hoặc gửi ý kiến phản hồi <a href="'.route('contact').'">tại đây</a><br />
                Xin trân thành cám ơn.
            </p>';
            $request->session()->flash("is_submit_post_pass",1);
            return view('cactus._include.infomation-text',$data);
        } else {
            return Redirect()->route('get-password')->with('Error','Thông tin email không tồn tại trong hệ thống chúng tôi');
        }
    }

    public function getResetPassword(Request $request) {
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => Route("get-login"),
                'label' => 'Đăng nhập'
            ]
        ];
        $data["breadcrumb"]["title"] = "Thiết lập lại mật khẩu";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();

        if (getUserInfo() == null) {
            $input     = $request->all();
            $customer  = Customer::select('id','name','email','check_sum')->where('check_sum','=',$input['check-sum'])->first();
            if ($customer) {
                $customer = $customer->toArray();
                $data['checkSum'] = $customer['check_sum'];
                return view('cactus.lost-pass-step2',$data);
            } else {
                $data['text'] =
                    '<p class="alert alert-danger">Dữ liệu trang web không hợp lệ, <br />
                    nếu cần sự trợ giúp vui lòng liên hệ theo hotline <strong>'.Config('global')['infomation_shop']['hotline'].'</strong> hoặc gửi ý kiến phản hồi <a href="'.route('contact').'">tại đây</a><br />
                    Xin trân thành cám ơn.
                </p>';
                return view('cactus._include.infomation-text',$data);
            }
        } else {
            return Redirect()->route('home');
        }
       
    }

    public function postResetPassword(Request $request) {
        $input = $request->all();
        Customer::where('check_sum','=',$input['check_sum'])->update([
            'password'  => bcrypt($input['password']),
            'check_sum' => NULL
        ]);
        $data['text'] = '<p class="alert alert-success">Tài khoản của bạn đã được khôi phục, <br />
                            nếu cần sự trợ giúp vui lòng liên hệ theo hotline <strong>'.Config('global')['infomation_shop']['hotline'].'</strong> hoặc gửi ý kiến phản hồi <a href="'.route('contact').'">tại đây</a><br />
                            Xin trân thành cám ơn.
                        </p>';
        return view('cactus._include.infomation-text',$data);
    }


}
