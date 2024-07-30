<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\cactus\Breadcrumb;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use URL;

class BlogController extends Controller
{

    protected static $ID_ABOUTUS = 1;
    protected static $_CACHE_KEY = "BLOG_PAGE";

    public function index() {
        if (Cache::has(self::$_CACHE_KEY)) {
            $data = Cache::get(self::$_CACHE_KEY);
        } else {
            $data["blogs"] = Blog::where("id","!=",1)->orderBy("updated_at")->paginate(Config("global.display_page"));

            $data["breadcrumb"]["title"] = "Blog";
            $data["breadcrumb"]["items"] = [
                [
                    'url'   => URL::to('/'),
                    'label' => 'Trang chủ'
                ],
                [
                    'url'   => '',
                    'label' => 'Blog'
                ]
            ];
            $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();
            Cache::put(self::$_CACHE_KEY, $data, env("TIME_CACHE",1440));
        }

        return view("cactus.blog", $data);
    }

    public function detail($slug, $id) {
        if (Cache::has(self::$_CACHE_KEY."_".$id)) {
            $data = Cache::get(self::$_CACHE_KEY."_".$id);
        } else {
            $blog = Blog::find($id);
            $data["breadcrumb"]["title"] = $blog->title;
            $data["breadcrumb"]["items"] = [
                [
                    'url'   => URL::to('/'),
                    'label' => 'Trang chủ'
                ],
                [
                    'url'   => '',
                    'label' => 'Blog'
                ]
            ];
            $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();
            $data["blog"] = $blog;
            Cache::put(self::$_CACHE_KEY."_".$id, $data, env("TIME_CACHE",1440));
        }
        return view("cactus.blog-detail", $data);
    }

    public function aboutUs() {
        if (Cache::has("ABOUT_US")) {
            $data = Cache::get("ABOUT_US");
        } else {
            $data["breadcrumb"]["title"] = 'About us';
            $data["breadcrumb"]["items"] = [
                [
                    'url'   => URL::to('/'),
                    'label' => 'Trang chủ'
                ],
                [
                    'url'   => '',
                    'label' => 'About us'
                ]
            ];
            $data["breadcrumb"]["bg"] = Breadcrumb::getBreadcrumb();
            $data["aboutUs"]          = Blog::where("id", self::$ID_ABOUTUS)->first();
            Cache::put("ABOUT_US", $data, env("TIME_CACHE",1440));
        }

        return view("cactus.about-us", $data);
    }
}
