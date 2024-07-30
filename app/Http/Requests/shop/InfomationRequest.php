<?php

namespace App\Http\Requests\shop;
use App\Http\Requests\Request;

class InfomationRequest extends Request
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
            'orderer_name'     => 'required',
            'orderer_phone'    => 'required',
            'orderer_email'    => 'required|email',
            'orderer_address'  => 'required',
            'orderer_province' => 'required',
            'orderer_district' => 'required',
            'orderer_ward'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'orderer_name.required'   => 'Vui lòng nhập họ tên',
            'orderer_phone.required'  => 'Vui lòng nhập số điện thoại',
            'orderer_email.required'  => 'Vui lòng nhập email',
            'order_email.email'       => 'Định dạng email không hợp lệ',
            'orderer_province.required'   => 'Vui lòng chọn tỉnh / thành',
            'orderer_district.required'   => 'Vui lòng chọn quận / huyện',
            'orderer_ward.required'       => 'Vui lòng chọn phường / xã'
        ];
    }
}
