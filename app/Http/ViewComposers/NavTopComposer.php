<?php namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\cactus\NavBar;

class NavTopComposer
{
    protected static $_TOP_MENU_KEY = "TOP_MENU";
    public function compose(View $view) {
        if (Cache::has(self::$_TOP_MENU_KEY)) {
            $data = Cache::get(self::$_TOP_MENU_KEY);
        } else {
            $data    = NavBar::topNavBar();
            Cache::put(self::$_TOP_MENU_KEY, $data, env("TIME_CACHE",1440));
        }
        $view->with("topMenu", $data);
        // get header cart
        $totalItem = $total = 0;
        $cart = [];
        if (session("shoppingcart")) {
            $cart  = session("shoppingcart");
            $cart  = json_decode($cart,true);
            foreach ($cart as $item) {
                $totalItem+= $item["quanlity"];
                $t = $item["price"]*$item["quanlity"];
                $total+=$t;
            }
        }
        $view->with('totalItem',$totalItem);
        $view->with("listCartItems", $cart);
        $view->with("totalPrice", $total);
    }

}

