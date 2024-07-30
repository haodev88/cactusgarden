<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\NewsLetter;
use App\Http\Requests\shop\NewLetterRequest;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller {

    protected static $_CACHE_KEY_HOME = "HOME_PAGE";

    public function index() {
        if (Cache::has(self::$_CACHE_KEY_HOME)) {
            $data = Cache::get(self::$_CACHE_KEY_HOME);
        } else {
            $data = [];
            $data["slider"]    =  $this->getSlider();
            $data["path"]      =  Config('global.path_upload_root');
            $data["product"]   =  $this->getProduct();
            $data["blog"]      =  $this->getBlog();
            Cache::put(self::$_CACHE_KEY_HOME, $data, env("TIME_CACHE",1440));
        }
        return view("cactus.index", $data);
    }


    protected function getSlider() {
        return Banner::whereIn('banner_position_id', [1,2,3,5])->get();
    }

    protected function getProduct() {
        $select = ["id","name","price","self_price","short_desc","default_image","filename","slug"];
        $data = Product::select($select)->orderBy("id","DESC")->limit(8)->get();
        if ($data->count() > 0) {
            $data = $data->toArray();
            return array_split($data,4);
        }
        return [];
    }

    public function getBlog() {
        $blog =  Blog::select(["title","author","image","updated_at","slug","id"])
            ->where('active',1)
            ->where('id','!=', 1)
            ->orderBy("id","DESC")
            ->limit(4)
            ->get();
        if ($blog->count() > 0) {
            return $blog;
        }
        return [];
    }

    /*
    public function getHomeAbout() {
        $homeAbout =  Blog::select(["title","author","image","short_desc"])
            ->where('active',1)
            ->where('id',1)->first();
        return $homeAbout;
    }
    */

    public function newsLetter(NewLetterRequest $request) {
        $email = $request->get("email", null);
        if ($email) {
            NewsLetter::updateOrCreate([
                "email"=>$email
            ],[
                "email"=>$email
            ]);
        }
        return Redirect(route('home').'#home-about-area')->with("successMessage", "Email của bạn đã được ghi nhận vào nhận tin. Xin cám ơn bạn");

    }
}
