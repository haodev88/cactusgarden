<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dt_categorys')->insert([
        	[
        		'title'	 	  => 'Mỹ Phẩm',
        		'slug'		  => 'my-pham',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Sức Khỏe',
        		'slug'		  => 'suc-khoe',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Điện Tử',
        		'slug'		  => 'dien-tu',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Gia Dụng',
        		'slug'		  => 'gia-dung',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Thiết bị văn phòng',
        		'slug'		  => 'thiet-bi-van-phong',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Đồ chơi - Lưu niệm',
        		'slug'		  => 'do-choi-luu-niem',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Dịch vụ',
        		'slug'		  => 'dich-vu',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'Thực phẩm',
        		'slug'		  => 'thuc-pham',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	],
        	[
        		'title'	 	  => 'sách',
        		'slug'		  => 'sach',
        		'parent_id'   =>  0,
        		'created_at'  => new DateTime()
        	]
        ]);
    }
}
