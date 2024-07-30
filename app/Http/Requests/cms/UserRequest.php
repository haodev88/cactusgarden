<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class UserRequest extends Request {
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
        $request = $this->request->all();
        // request of add
        if ($action == 'store') {
            return [
                'txtUser'       => 'required|unique:users,username',
                'txtName'       => 'required',
                'txtEmail'      => 'required|email|unique:users,email',
                'txtPass'       => 'required',
                'txtFile'       => 'image',
                'sltGroup'      => 'required'
            ];
        } else {
            return [
                'txtUser'       => 'required|unique:users,username,'.$request['id'],
                'txtName'       => 'required',
                'txtEmail'      => 'required|email|unique:users,email,'.$request['id'],
                'txtFile'       => 'image'
            ];
        }
    }

    public function messages() {
        return [
            'txtUser.required'  => 'Vui lòng nhập tài khoản',
            'txtUser.unique'    => 'Tài khoản này đã tồn tại',
            'txtName.required'  => 'Vui lòng nhập họ tên',
            'txtEmail.required' => 'Vui lòng nhập email',
            'txtEmail.unique'   => 'Email này đã tồn tại',
            'txtEmail.email'    => 'Định dạng email không chính xác',
            'txtPass.required'  => 'Vui lòng nhập mật khẩu',            
            'txtFile.image'     => 'Hình ảnh không đúng định dạng',
            'sltGroup.required' => 'Vui lòng chọn ít nhất một nhóm'
        ];
    }
}
