<?php

namespace App\Http\Requests\shop;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required|email|unique:dt_customers,email',
            'password'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.requird'        => 'Vui lòng nhập họ tên',
            'email.required'      => 'Vui lòng nhập email',
            'email.email'         => 'Định dạng email không hợp lệ',
            'password.required'   => 'Vui lòng nhập mật khẩu',
            'email.unique'        => 'Email này đã được sử dụng.',
        ];
    }
}
