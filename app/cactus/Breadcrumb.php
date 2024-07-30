<?php

namespace App\cactus;

use URL;
use App\Models\Banner;

class Breadcrumb
{
    public static function getBreadcrumb() {
        $bgBreadcrumb = Banner::where("banner_position_id",4)->first();
        if ($bgBreadcrumb) {
            return URL::to("/").Config("global.root_media")."banners/".$bgBreadcrumb->source;
        }
        return '';
    }
}
