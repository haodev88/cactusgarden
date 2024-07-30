<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;

class PageRequest extends Request
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
        $request = $this->request;
        $valid = [
            'name'    => 'required',
            'slug'    => 'required',
            'content' => 'required',
        ];
        $action = getActionName($this);
        if ($action == "update") {
            $valid['code'] ='required|unique:dt_page,code,'.$request->get('id');
        } else {
            $valid['code'] ='required|unique:dt_page,code';
        }
        return $valid;
    }
}
