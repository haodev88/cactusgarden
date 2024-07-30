<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//include_once('route/route_test.php');
// include_once('route/route_get_data.php');
// include_once('route/route_test.php');

/**
 * Route::domain(env('DOMAIN_TANG_QUA'))->group(function () {
Route::any('/',	['uses' => 'Web\Unilever\UnileverController@redeem'])->name('redeem');
});
 */
/*
if (isset($_SERVER["SERVER_NAME"])) {
    if ($_SERVER["SERVER_NAME"]!= env("APP_DOMAIN")) {
        abort(404);
    }
}
*/

Route::group(['prefix' => 'admin_shop','namespace'=>'Admin'],function() {
    /** AUTH ROUTE **/
    Route::get('/auth', ['as'=>'getLogin', 'uses'   =>'LoginController@getLogin']);
    Route::post('/auth',['as'=>'postLogin','before' => 'csrf','uses'=>'LoginController@postLogin']);
    Route::get('/logout',['as'=>'getLogout', 'uses' => 'LoginController@getLogout']);
    Route::get('/403',['as'=>'403-error','uses' => 'ErrorController@error403']);
   
    /** END ROUTE LOGIN **/
    Route::group(['middleware' => ['auth','check.permission']], function() {
        /**************************** ROUTE FOR MAIN **************************************************/
        Route::get('/dashboard',['as'=>'index','uses'=>'DashboardController@index']);
        /*** Route for categoty ***/
        Route::get('/category/search', ['as'=>'searchCate','uses'=>'CategoryController@search']);
        Route::resource('category','CategoryController');
        /*** Route for product ***/
        Route::get('/product/search',['as'=>'searchproduct','uses'=>'ProductController@search']);
        Route::resource('product','ProductController');
        /*** Route for brand ***/
        Route::get('/brand/search',['as'=>'searchbrand', 'uses'=>'BrandController@search']);
        Route::resource('brand','BrandController');
        /*** Route for supplier ***/
        Route::get('/supplier/search',['as'=>'searchsupplier', 'uses'=>'SupplierController@search']);
        Route::resource('supplier','SupplierController');
        /*** Route for buyer ***/
        Route::get('/buyer/search',['as'=>'searchbuyer', 'uses'=>'BuyerController@search']);
        Route::resource('/buyer','BuyerController');
        /*** Route for option group ***/
        Route::get('/option-group/search',['as'=>'search-option-group', 'uses'=>'OptionGroupController@search']);
        Route::resource('/option-group','OptionGroupController');
        /*** Route for option ***/
        Route::get('/option/search',['as'=>'search-option','uses'=>'OptionController@search']);
        Route::resource('/option','OptionController');
        /*** Route User ***/
        Route::get('/user/search',['as'=>'searchUser','uses'=>'UserController@search']);
        Route::resource('/user','UserController');
        /*** Route for user group ***/
        Route::get('/group/search',['as'=>'searchUserGroup','uses'=>'UserGroupController@search']);
        Route::resource('/group','UserGroupController');
        /*** Route for permission ***/
        Route::get('/permission/search',['as'=>'searchPermission','uses'=>'PermissionController@search']);
        Route::resource('/permission','PermissionController');
        /*** Route for role ***/
        Route::get('/role/search',['as'=>'searchRole','uses'=>'RoleController@search']);
        Route::resource('/role','RoleController');
        /*** Route for customer ****/
        Route::get('/customer/search',['as'=>'searchCumtomer','uses'=>'CustomerController@search']);
        Route::resource('/customer','CustomerController');
        /*** Route Order ***/
        Route::post('/order/change-order-info',['as'=>'changeOrderInfo','uses'=>'OrderController@changeOrderInfo']);
        Route::get('/order/add-order-product',['as'=>'addOrderProduct','uses'=>'OrderController@addOrderProduct']);
        Route::get('/order/choose-option',['as'=>'chooseOption','uses'=>'OrderController@chooseAtrribuite']);
        Route::get('/order/edit-quanlity',['as'=>'editQuanlity','uses'=>'OrderController@editQuanlity']);
        Route::get('/order/delete-item',  ['as'=>'deleteItem','uses'=>'OrderController@deleteItem']);
        Route::get('/order/search',['as'=>'searchOrder','uses'=>'OrderController@search']);
        Route::resource('/order','OrderController');
        /*** Route For banner ***/
        Route::post('/banner/update',['as'=>'uploadBanner','uses'=>'BannerController@upload']);
        Route::get('/banner/delete/{id}', ['as'=>'clearBanner', 'uses'=>'BannerController@clear'])->where('id','[0-9]+');
        Route::post('/banner/update-data',['as'=>'updateBanner','uses'=>'BannerController@updateDataBanner']);
        Route::resource('/banner','BannerController');
        /*** Route For Contact ***/
        Route::resource('/contact','ContactController');
        /** Route For blog */
        Route::resource('/blog','BlogController');
        Route::resource('/page','PageController');
        /**************************** END ROUTE FOR MAIN *********************************************/
        /** Route For Ajax Request **/
        Route::get('/get_brand',   ['as'=>'get_brand','uses'=>'AjaxRequestController@getBrand']);
        Route::get('/check_sku',   ['as'=>'check_sku','uses'=>'AjaxRequestController@checkSku']);
        Route::get('/get_district',['as'=>'get_district','uses'=>'AjaxRequestController@getDistrict']);
        Route::get('/get_ward',    ['as'=>'get_ward','uses'=>'AjaxRequestController@getWard']);
        Route::get('/save_order_status',['as'=>'save_order_status','uses'=>'AjaxRequestController@saveOrderStatus']);
    });
});



/** =========================== Front-end-shop ====================================================**/

Route::group(['namespace'=>'shop'],function() {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    // Route::get('/san-pham.html',        ['as'=>'cdp','uses'=>'ProductController@cdp']);
    Route::get('/san-pham/{alias}.html',['as'=>'product','uses'=>'ProductController@getProduct'])->where(['alias' =>'[a-zA-Z0-9._\/-]+']);
    Route::get('/chi-tiet-san-pham/{alias}-{id}.html',['as'=>'detail','uses'=>'DetailController@getItem'])->where(['alias'=>'[a-zA-Z0-9._\/-]+','id'=>'[0-9]+']);
    // brand page
    Route::get('thuong-hieu/{brand}.html',['as'=>'brand','uses'=>'BrandController@getBrand'])->where(['brand'=>'[a-zA-Z0-9._\/-]+']);
    // contact
    Route::get('/lien-he',['as'=>'contact','uses'=>'ContactController@getContact']);
    Route::post('/lien-he',['as'=>'post-contact','uses'=>'ContactController@postContact']);
    // shopping cart
    Route::post('/shopping/add',['as'=>'add-cart','uses'=>'ShoppingController@add']);
    Route::post('/shopping/update',['as'=>'update-cart','uses'=>'ShoppingController@update']);
    Route::get('/shopping/view',['as'=>'view-cart','uses'=>'ShoppingController@get']);
    Route::post('/shopping/delete',['as'=>'delete-cart','uses'=>'ShoppingController@delete']);
    Route::get('/shopping/clear',['as'=>'clear-cart','uses'=>'ShoppingController@clear']);
    // order item
    Route::get('/order/infomation',['as'=>'order-infomation','uses'=>'OrderController@infomation']);
    Route::post('/order/infomation',['as'=>'post-infomation','uses'=>'OrderController@postInfomation']);
    Route::get('/order/success',['as'=>'order-success','uses'=>'OrderController@success']);

    // search product
    Route::get('tim-kiem-san-pham.html',['as'=>'search-product','uses'=>'SearchController@get']);
    // about us
    Route::get('/about-us',["as"=>"about-us",'uses'=>'BlogController@aboutUs']);

    // auth member
    Route::group(['prefix' => 'tai-khoan'], function () {
        Route::get('dang-ky',  ['as'=>'get-register','uses'=>'AuthController@getRegister']);
        Route::post('dang-ky', ['as'=>'post-register','uses'=>'AuthController@postRegister']);
        Route::get('dang-nhap',['as'=>'get-login','uses'=>'AuthController@getLogin']);
        Route::post('dang-nhap',['as'=>'post-login','uses'=>'AuthController@postLogin']);
        Route::get('dang-xuat',['as'=>'logout','uses'  =>'AuthController@logout']);
        Route::get('quen-mat-khau', ['as'=>'get-password','uses'=>'AuthController@getPassword']);
        Route::post('quen-mat-khau',['as'=>'post-password','uses'=>'AuthController@postPassword']);
        Route::get('khoi-phuc-mat-khau', ['as'=>'get-reset-password','uses'=>'AuthController@getResetPassword']);
        Route::post('khoi-phuc-mat-khau',['as'=>'post-reset-password','uses'=>'AuthController@postResetPassword']);

    });

    // Route for account
    Route::group(["prefix" => "quan-ly"], function () {
        Route::group(["middleware"=>"isLogin"], function () {
            Route::get('/',  ['as'=>'account_dashboard', 'uses'=> 'AccountController@Dashboard']);
            Route::get('/don-hang',   ['as'=>'my_order',   'uses'=> 'AccountController@MyOrder']);
            Route::get('/tai-khoan',  ['as'=>'my_account', 'uses'=> 'AccountController@MyAccount']);
            Route::post('/tai-khoan', ['as'=>'post_my_account', 'uses'=> 'AccountController@postMyaccount']);
            Route::get('/don-hang/mon-hang/{id}', ['as'=>'my_order_detail', 'uses'=> 'AccountController@orderDetail'])->where(['id'=>'[0-9]+']);
        });
    });

    // Ajax Request
    Route::get('get-district',['as'=>'get-provice','uses'=>'AjaxController@getDistrict']);
    Route::get('get-ward',    ['as'=>'get-ward','uses'=>'AjaxController@getWard']);
    // Route blog
    Route::get("/blog", ["as"=>"blog", "uses"=>"BlogController@index"]);
    Route::get("/blog/{slug}-{id}", ["as"=>"blog-detail", "uses"=>"BlogController@detail"])->where(['slug'=>'[a-zA-Z0-9._\/-]+','id'=>'[0-9]+']);
    // post new letter
    Route::post("/newletter", ["as"=>"new_letter", "uses"=>"HomeController@newsLetter"]);
    // route for create lading page
    Route::get("/trang/{slug}", ["as"=>"landing-page", "uses"=>"PageController@index"]);

});
Route::auth();
Route::get('/home', 'HomeController@index');

Route::get("/clear-cache", function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

/*
Route::get('/test/email', function() {

    $orderInfo = [];
    Mail::send('template-email.mailEvent', ['orderInfo' => $orderInfo], function($message) use ($orderInfo) {
        $message->to("wallacehao520@gmail.com");
        $message->subject('Thông Tin Đơn Hàng');
    });
    echo  "okie";
});
*/