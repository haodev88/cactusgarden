<?php

namespace App\Http\Requests\cms;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class OptionRequest extends Request
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
        // echo '<pre>';
        //     print_r($request);
        // echo '</pre>';
        // die;
        $action  = getActionName($route);
        if ($action == 'store') {
            return [
                'txtName'  => 'required'
            ];
        } else {
            return [
                'txtName'  => 'required'
            ];
        }
    }
}
