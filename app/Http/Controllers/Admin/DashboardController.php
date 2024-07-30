<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class DashboardController extends Controller {
    /**
    *
    * Show data in dashboard
    */
    public function index() {
    	return view('cms.dashboard');
    }
}
