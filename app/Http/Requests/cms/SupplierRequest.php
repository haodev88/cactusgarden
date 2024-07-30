<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class SupplierRequest extends Request
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
    public function rules() {
        return [
            'txtSupplier' =>  'required',
            'sltBuyer'    =>  'required',
            'txtAddress'  =>  'required',
            'txtFile'     =>  'image',
            'brand_id'    =>  'required'
        ];
    }
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'txtSupplier.required'  => 'Vui lòng nhập tên nhà cung cấp.',
            'txtAddress.required'   => 'Vui lòng nhập địa chỉ nhà cung cấp.',
            'sltBuyer.required'     => 'Vui lòng chọn nhân viên thu mua.',
            'txtFile.image'         => 'Ảnh không đúng định dạng.',
            'brand_id.required'     => 'Vui lòng chọn ít nhất 1 thương hiệu.'
        ];
    }
}
