<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dt_options')->insert([
        	[
        		'dt_option_group_id'=>1,
        		'name'=>'Màu đỏ',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>1,
        		'name'=>'Màu xanh',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>1,
        		'name'=>'Màu vàng',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>1,
        		'name'=>'Màu tím',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>1,
        		'name'=>'Màu hồng',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>2,
        		'name'=>'L',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>2,
        		'name'=>'S',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_option_group_id'=>2,
        		'name'=>'M',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	]
        ]);
    }
}
