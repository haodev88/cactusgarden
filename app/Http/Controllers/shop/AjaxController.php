<?php

namespace App\Http\Controllers\shop;

use App\Models\Ward;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\District;

class AjaxController extends Controller {

    public function getDistrict(Request $request) {
        if ($request->ajax()) {
            $input    = $request->all();
            $district = District::where('provinceid','=',$input['id']);
            if ($district->count()!=0) {
                $output = $district->get()->toArray();
                return Response()->json($output);
            }
        }
    }

    public function getWard(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $ward  = Ward::where('districtid','=',$input['id']);
            if ($ward) {
                $output = $ward->get()->toArray();
                return Response()->json($output);
            }
        }
    }

}
