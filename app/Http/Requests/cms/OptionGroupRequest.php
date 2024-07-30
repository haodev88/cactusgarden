<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class OptionGroupRequest extends Request
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
        $request = $this->request->all();
        $action  = getActionName($this);
        if ($action == 'store') {
            return [
                'txtName'  => 'required|unique:dt_option_groups,name'
            ];
        } else {
            return [
                'txtName'  => 'required|unique:dt_option_groups,name,'.$request['id']
            ];
        }
    }

    public function messages() {
        return [
            'txtName.required'  => 'Vui lòng nhập tên nhóm thuộc tính',
            'txtName.unique'    => 'Tên nhóm thuộc tính này đã tồn tại'
        ];
    }

}
