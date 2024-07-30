<?php

use Illuminate\Database\Seeder;

class OptionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('dt_option_groups')->insert([
    		[
    			'name'		=> 'Màu sắc',
    			'created_at'=> new DateTime(),
    			'updated_at'=> new DateTime()
    		],
    		[
    			'name'		=> 'Kích thước',
    			'created_at'=> new DateTime(),
    			'updated_at'=> new DateTime()
    		],
    		[
    			'name'		=> 'Xuất xứ',
    			'created_at'=> new DateTime(),
    			'updated_at'=> new DateTime()
    		],
    		[
    			'name'		=> 'Chất liệu',
    			'created_at'=> new DateTime(),
    			'updated_at'=> new DateTime()
    		]
    	]);
    }
}
