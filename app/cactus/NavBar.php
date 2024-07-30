<?php

namespace App\cactus;

use URL;
use App\Models\Category;

class NavBar {

    public static function topNavBar() {
        return self::getItemTopNav();
    }

    protected static function getItemTopNav() {
        return [
            [
                'label' => 'Trang chủ',
                'url'   =>  URL::to("/")
            ],
            [
                'label' => 'About us',
                'url'   => Route("about-us"),
            ],
            [
                'label'   => 'Sản Phẩm',
                'url'     => 'javascript:void(0)',
                'dropdown'=> self::getCategoryParent()
            ],
            [
                'label' => 'Blog',
                'url'   => Route("blog"),
            ],
            [
                'label' => 'Liên hệ',
                'url'   => route("contact")
            ]
        ];

    }

    protected static function getCategoryParent() {
        $category = Category::where("parent_id",0)->get();
        $data = "<ul class='dropdown'>";
        if ($category->count()!=0) {
            foreach ($category as $_item) {
                $data.= '<li><a href="'.route('product',['alias'=>$_item->slug]).'">'.$_item->title.'</a></li>';
            }
        }
        $data.="</ul>";
        return $data;
    }

}
