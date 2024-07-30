<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class BrandRequest extends Request
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
        $action  = getActionName($this);
        // request of add
        if ($action == 'store') {
            return [
                'txtBrand'  =>  'required',
                'txtFile'   =>  'image'
            ];
        } else {
            return [
                'txtBrand'  =>  'required',
                'txtFile'   =>  'image'
            ];
        }
    }

    public function messages() {
        return [
            'txtBrand.required'  => 'Vui lòng nhập tên thương hiệu',
            'txtFile.image'      => 'Hình ảnh không đúng định dạng'
        ];
    }


}
