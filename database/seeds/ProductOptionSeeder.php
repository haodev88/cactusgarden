<?php

use Illuminate\Database\Seeder;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dt_product_options')->insert([
        	[
        		'dt_product_id'=>1,
        		'dt_option_id' =>1
        	],
        	[
        		'dt_product_id'=>1,
        		'dt_option_id' =>2
        	],
        	[
        		'dt_product_id'=>1,
        		'dt_option_id' =>3
        	],
        	[
        		'dt_product_id'=>1,
        		'dt_option_id' =>4
        	],
        	[
        		'dt_product_id'=>1,
        		'dt_option_id' =>5
        	],
        	[
        		'dt_product_id'=>2,
        		'dt_option_id' =>3
        	],
        	[
        		'dt_product_id'=>2,
        		'dt_option_id' =>1
        	],
        	[
        		'dt_product_id'=>2,
        		'dt_option_id' =>4
        	],
        ]);
    }
}
