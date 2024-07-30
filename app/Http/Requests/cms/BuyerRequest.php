<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class BuyerRequest extends Request {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $request = $this->request->all();
        $action  = getActionName($this);
        // request of add
        if ($action == 'store') {
            return [
                'txtName'     =>  'required',
                'txtEmail'    =>  'required|email|unique:dt_buyers,email',
                'txtAddress'  =>  'required',
                'txtPhone'    =>  'required'  
            ];
        } else {
            return [
                'txtName'     =>  'required',
                'txtEmail'    =>  'required|email|unique:dt_buyers,email,'.$request['id'],
                'txtAddress'  =>  'required',
                'txtPhone'    =>  'required'  
            ];
        }
    }

    public function messages() {
        return [
            'txtName.required'     =>  'Vui lòng nhập tên nhân viên thu mua.',
            'txtEmail.required'    =>  'Vui lòng nhập email.',
            'txtEmail.email'       =>  'Định dạng email không hợp lệ',
            'txtEmail.unique'      =>  'Email này đã được sử dụng.',
            'txtAddress.required'  =>  'Vui lòng nhập địa chỉ.',
            'txtPhone.required'    =>  'Vui lòng nhập điện thoại.'  
        ];
    }

}
