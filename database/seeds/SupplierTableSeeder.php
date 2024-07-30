<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dt_suppliers')->insert([
        	[
        		'user_id'     => 1,
                'dt_buyer_id' => 1,
        		'name'=>'Vĩnh phát',
        		'address'=>'259 nguyễn chí thanh, p12, q5',
				'short_desc'=>'Mô tả ngắn',
				'long_desc'=>'Mô tả dài',
        		'filename'=>''
        	],
        	[
        		'user_id'=>1,
                'dt_buyer_id' => 1,
        		'name'=>'kiến quang',
        		'address'=>'329 nguyễn chí thanh, p11, q11',
				'short_desc'=>'Mô tả dài',
				'long_desc'=>'Mô tả dài',
        		'filename'=>''
        	],
        ]);
    }
}
