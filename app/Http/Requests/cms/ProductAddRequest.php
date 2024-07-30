<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;

class ProductAddRequest extends Request
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
        $rules = [
            'sltCategory'   => 'required',
            'sltSupplier'   => 'required',
            'sltBrand'      => 'required',
            'txtSku'        => 'required|unique:dt_products,sku',
            'txtName'       => 'required',
            'txtPrice'      => 'required',
            'txtCount'      => 'required'
        ];
        $files = $this->file('txtFile');
        if (isset($files[0])) {
            $nbr   = count($this->file('txtFile')) - 1;
            foreach(range(0, $nbr) as $index) {
                // $rules['txtFile.' . $index] = 'image|mimes:png,jpg,jpeg,bmp';
                $rules['txtFile.' . $index] = 'image';
            }
        }
        return $rules;
    }

    /**
     * Message error
     */
    public function messages()  {
        $messages = [
            'sltCategory.required'  => 'Vui lòng chọn danh mục',
            'sltSupplier.required'  => 'Vui lòng chọn nhà cung cấp',
            'sltBrand.required'     => 'Vui lòng chọn thương hiệu',
            'txtSku.required'       => 'Vui lòng nhập mã SKU',
            'txtSku.unique'         => 'SKU này đã tồn tại',
            'txtName.required'      => 'Vui lòng nhập tên sản phẩm',
            'txtPrice.required'     => 'Vui lòng nhập giá bán',
            'txtCount.required'     => 'Vui lòng nhập số lượng'
        ];
        $files = $this->file('txtFile');
        if (isset($files[0])) {
            $nbr = count($this->file('txtFile')) - 1;
            foreach(range(0, $nbr) as $index) {
                // $messages['txtFile.'.$index.'.required'] = 'Hình ảnh vị trí thứ '.($index+1).' không hợp lệ';
                $messages['txtFile.'.$index.'.image']    = 'Hình ảnh vị trí thứ '.($index+1).' không hợp lệ';
                // $messages['txtFile.'.$index.'.mimes']    = 'Hình ảnh vị trí thứ '.($index+1).' phải là kiểu: png,jpg,jpeg,bmp';
            }
        }
        return $messages;
    }
}
