<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;


class RoleRequest extends Request {
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
        $input = $this->request->all();
        $action  = getActionName($this);
        if ($action == 'store') {
            return [
                'txtRole'     =>  'required|unique:roles,name',
            ];
        } else {
            return [
                'txtRole'     =>  'required|unique:roles,name,'.$input['id'],
            ];
        }
    }

    public function messages() {
        return [
            'txtRole.required'    =>  'Vui lòng nhập tên chức năng.',
            'txtRole.unique'      =>  'Tên chức năng này đã tồn tại'
        ];
    }
}
