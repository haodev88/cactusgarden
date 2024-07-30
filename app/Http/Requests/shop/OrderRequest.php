<?php

namespace App\Http\Requests\shop;

use App\Http\Requests\Request;

class OrderRequest extends Request
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
            "orderer_name"      => "required",
            "orderer_phone"     => "required",
            "orderer_email"     => "required",
            "orderer_address"   => "required",
            "dd_province"       => "required",
            "dd_district"       => "required",
            "dd_ward"           => "required",
        ];
    }
}
