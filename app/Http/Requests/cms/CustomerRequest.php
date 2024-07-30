<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class CustomerRequest extends Request
{
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
        if ($action == 'store') {
            return [
                'txtName'     => 'required',
                'txtEmail'    => 'required|email|unique:dt_customers,email',
                'txtPassword' => 'required',
                'txtPhone'    => 'required'
            ];
        } else {
            return [
                'txtName'     => 'required',
                'txtEmail'    => 'required|email|unique:dt_customers,email,'.$request['id'],
                'txtPhone'    => 'required'
            ];
        }
    }

    public function messages() {
        return [
            'txtName.required'    => 'Vui lòng nhập họ tên.',
            'txtEmail.email'      => 'Định dạng email không chính xác.',
            'txtPassword.required'=> 'Vui lòng nhập mật khẩu',
            'txtEmail.required'   => 'Vui lòng nhập email.',
            'txtEmail.unique'     => 'Email này đã được sử dụng.',
            'txtPhone.required'   => 'Vui lòng nhập số điện thoại'
        ];
    }
}
