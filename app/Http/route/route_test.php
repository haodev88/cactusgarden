<?php

	/**
	|---------------------------------------
	| Test Middleware
	|----------------------------------------
	*/
	Route::group(['middleware'=>'terminate'],function() {
	    Route::get('test',function() {
	        echo "Ok";
	    });
	});
	/**
	|------------------------------------------------------------------
	| Test eloquent
	|------------------------------------------------------------------
	*/

	Route::get('test/orm',function() {
		$p = App\Models\Product::with(['category'=>function($query) {
			$query->select('id', 'title');
		}])->get()->toArray();
		/*
		$p = App\Models\Product::all();
		foreach ($p as $key => $item) {
			echo 'Tên sp :'. $item->name.'<br />';
			echo 'Thuộc danh mục :'.$item->category->title.'<br />';
		}
		*/
	});

	/**
	|------------------------------------------------------------------
	| Test Eloquent Many To Many
	|------------------------------------------------------------------
	*/
	Route::get('test/many_to_many',function() {
		$s = App\Models\Supplier::where("id","=",1);
		$a = $s->with(['brand'=>function($query){
			$query->select('id', 'name');
		}])->get()->toArray();
		echo "<pre>";
			print_r($a);
		echo "</pre>";
	});

	/**
	|------------------------------------------------------------------
	| Test Hash password
	|------------------------------------------------------------------
	*/
	Route::get('test/hash',function() {
		$p = Hash::make("123456");
		if (Hash::check('123456', $p)) {
    		echo "OK";
		}
	});

	/**
	|------------------------------------------------------------------
	| Attach data ManyToMany
	|------------------------------------------------------------------
	*/
	Route::get('/test/attach',function() {
		$s = App\Models\Supplier::find(2);
		$s->brand()->attach();
	});

	/**
	|-------------------------------------------------------------------
	| Detach data Many to Many
	|-------------------------------------------------------------------
	*/
	Route::get('/test/detach',function() {
		$s = App\Models\Supplier::find(2);
		$s->brand()->detach(5);
	});

	/**
	|-------------------------------------------------------------------
	| Test option group
	|-------------------------------------------------------------------
	*/

	Route::get('/test/option',function() {
		$group = App\Models\OptionGroup::with("option")->get()->toArray();
		echo "<pre>";
			print_r($group);
		echo "</pre>";
	});

	/**
	|-------------------------------------------------------------------
	| Test product option
	|-------------------------------------------------------------------
	*/
	Route::get('/test/product_option',function() {
		$p = App\Models\Product::where("id","=",1)->first();
		$c = $p->option()->with('optionGroup')->get()->toArray();
		$attribute = [];
		foreach ($c as $key => $value) {
			$groupName = $value['option_group']['name'];
			$attribute[$groupName][] = [
				"id"  => $value["id"],
				"name"=> $value["name"]
			];
		}


		/*
		$p = Product::where('id','=',$id)->with(['option'=>function($q) {
            $q->select('id','name');
        }])->get(['dt_products.id'])->toArray();
		*/
		echo "<pre>";
			print_r($attribute);
		echo "</pre>";
	});

	/**
	|-------------------------------------------------------------------
	| RESIZE IMAGE
	|-------------------------------------------------------------------
	*/
	Route::get('test/resize-image',function() {
		// http://image.intervention.io/use/basics
		$img = Image::make('uploads/1471149474_1460994540_new.jpg')
			->circle(70, 150, 100)
		    ->resize(300, 200)
		    ->save('uploads/thumbs/300x200_bar.jpg');

	});

	/**
	|-------------------------------------------------------------------
	| testing for create forder
	|-------------------------------------------------------------------
	*/
	Route::get('test/create-folder',function() {
		$folderCreate = date('y').'/'.date('m').'/'.date('d');
		File::makeDirectory('uploads/mains/'.$folderCreate, $mode = 0777, true, true);
	});

	/**
	|-------------------------------------------------------------------
	| testing for get config size images
	|-------------------------------------------------------------------
	*/
	Route::get('test/get-size',function() {
		$productSize = config('global.size_product');
		echo "<pre>";
			print_r($productSize);
		echo "</pre>";
	});

	/**
	|-------------------------------------------------------------------
	| Detach product-option
	|-------------------------------------------------------------------
	*/
	Route::get('/test/detach-option',function() {
		// $p = App\Models\Product::find(13)->option()->detach([13,2]);
		// echo "Ok";
	});

	Route::get('test/supplier_brand_buyer',function() {
		/*
		$buyer = App\Models\Buyer::with('supplier')->select('id','name')->find(1)->toArray();
		echo '<pre>';
			print_r($buyer);
		echo '</pre>';
		*/
	});


	Route::get('test/get-action',['middleware'=>'check.permission',function() {
		return "do anything";
	}]);

	Route::get('del-controller',function() {
		$a = App\Models\FeautureController::find(1);
		$a->user()->detach();
		echo "Ok";

	});

	Route::get('/test/product-option',function() {
		$p = \App\Models\Product::find(1);
		$c = $p->option()->with('optionGroup')->get()->toArray();
		echo '<pre>';
			print_r($c);
		echo '</pre>';
	});

	Route::get('/test/email', function() {

        $orderInfo = [];
        Mail::send('template-email.mailEvent', ['orderInfo' => $orderInfo], function($message) use ($orderInfo) {
            $message->to("wallacehao520@gmail.com");
            $message->subject('Thông Tin Đơn Hàng');
        });
		echo  "okie";
	});







?>
