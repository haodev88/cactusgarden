<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class PermissionActionRequest extends Request {
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
    public function rules(Route $route) {
        $action  = getActionName($route);
        $request = $this->request->all();
        // request of add
        if ($action == 'store') {
            return [
                'txtPermission'  =>  'required|unique:controllers,controller_name',
                'txtAction'      =>  'required'
            ];
        } else {
            return [
                'txtPermission'  =>  'required|unique:controllers,controller_name,'.$request["id"],
                'txtAction'      =>  'required'
            ];
        }
    }

    public function messages() {
        return [
            'txtPermission.required'  => 'Vui lòng nhập tên controller',
            'txtPermission.unique'    => 'Controller này đã tồn tại',
            'txtAction.required'      => 'Vui lòng nhập tên action'
        ];
    }
}
