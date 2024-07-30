<?php
    Route::get('get-data-shop',['uses'=>'getShop\getShopController@index']);
    Route::get('send-email',function() {
        $user["email"] = "wallacehao520@gmail.com";
        $user["name"]  = "hao tran";
        Mail::send('template-email.test-email', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('E-Mail Example');
        });
    });

    Route::get('template-order', function() {
        $orderCode = '2017010104';
        $orderInfo = \App\Models\Order::where('order_code','=',$orderCode)->first();
        Mail::send('template-email.email-order', ['orderInfo' => $orderInfo], function($message) use ($orderInfo) {
            $message->to($orderInfo->orderDelivery->order_email);
            $message->subject('Thông Tin Đơn Hàng');
        });
        // $data['orderInfo'] = \App\Models\Order::where('order_code','=',2017010104)->first();
        // return view('template-email.email-order',$data);
    });

    Route::get('/test/event',function() {
        Event::fire(new \App\Events\SendMail(4));
        echo "Ok";
    });


    Route::get('de-quy-danh-muc',function() {
        $id        = 10;
        $listCate  = getChildCate($id);
        $product   = \App\Models\Product::select('id','name')->whereIn('dt_category_id',$listCate)->get()->toArray();
        echo "<pre>";
            print_r($product);
        echo "</pre>";
    });


    /*
    Route::auth();
    Route::group(['middleware' => ['auth','check.permission'], 'namespace'=>'Admin'], function() {
        Route::get('/home', 'HomeController@index');
        Route::resource('users','UserController');
        
        // Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
        Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index']);
        Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
        Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
        Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
        Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
        Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
        Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
      
        Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
        Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
        Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
        Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
        Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
        Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
        Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);

    });
    */


?>