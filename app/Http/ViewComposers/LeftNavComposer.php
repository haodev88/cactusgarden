<?php namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\cactus\NavBar;
use App\Models\Category;

class LeftNavComposer
{

    public function compose(View $view) {
        $alias = null;
        if (isset($view->getData()['alias'])) {
            $alias = $view->getData()['alias'];
        }
        $cate  = Category::orderBy('order_by','ASC')->get()->toArray();
        $newCate = [];
        foreach ($cate as $item) {
            $newCate[$item["parent_id"]][] = $item;
        }

        $sub = subMenu($newCate,0, $alias);
        $view->with('sub', $sub);

    }

}

