<?php

namespace App\Http\Requests\shop;

use App\Http\Requests\Request;

class NewLetterRequest extends Request
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
            'email'     => 'required|email|unique:dt_news_letter,email'
        ];
    }

    public function messages()
    {
        return [
            'email.email'       => 'Định dạng email không hợp lệ',
            'email.required'    => 'Vui lòng nhập email',
            'email.unique'      => 'Email này đã được đăng ký nhận tin',
        ];
    }
}
