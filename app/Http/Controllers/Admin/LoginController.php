<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show Form Login
     */
    public function getLogin() {
    	if (Auth::check()) {
    		return Redirect()->route('index');
    	} else {
    		return view("cms.auth.login-form");
    	}
    }

    /**
    * Post data and check exists
    */
    public function postLogin(AuthRequest $request) {
    	$input = $request->all();
        $data = [
            "username"=> $input["username"],
            "password"=> $input["password"]
        ];
        if (Auth::attempt($data)) {
            return Redirect()->route('index');
        } else {
            return Redirect()->route('getLogin')->with('Error','Thông tin đăng nhập không chính xác.');
        }
    }

    /**
    *
    * Logout user
    */
    public function getLogout() {
        Auth::logout();
        return Redirect()->route('getLogin');

    }
}
