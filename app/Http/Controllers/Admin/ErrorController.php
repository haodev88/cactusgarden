<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorController extends Controller {
	
	public function error403() {
		return view('errors.cms.403');
	}
	
}
