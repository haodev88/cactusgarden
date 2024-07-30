<?php

namespace App\Http\Requests\shop;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'name'  =>'required',
            'email' =>'required|email',
            'phone' =>'required|numeric',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email'    => 'Email không đúng định dạng',
            'phone.required' => 'Vui lòng nhập điện thoại',
            'phone.numeric'        => 'Điện thoại phải là số',
            'g-recaptcha-response' => 'Capcha không hợp lệ'
        ];
    }
}
