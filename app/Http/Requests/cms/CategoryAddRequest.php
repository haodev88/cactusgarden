<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;

class CategoryAddRequest extends Request
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
            'sltCate' => 'required',
            'txtCate' => 'required'
        ];
    }

    public function messages() 
    {
        return [
            'sltCate.required'  => 'Vui lòng chọn danh mục gốc',
            'txtCate.required'  => 'Vui lòng nhập tên danh mục'
        ];
    }
}
