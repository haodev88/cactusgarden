<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\cactus\Breadcrumb;
use App\Models\Page;
use URL;

class PageController extends Controller
{
    public function index($slug) {
        $page = Page::where("slug", $slug)->first();
        $data["page"]       = $page;
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ]
        ];
        $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();
        $data["breadcrumb"]["title"] = $page->name;

        return view("cactus.page", $data);
    }

}
