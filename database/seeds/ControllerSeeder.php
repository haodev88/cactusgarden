<?php

use Illuminate\Database\Seeder;

class ControllerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('controllers')->insert([
        	[
        		'controller_name'	=> 'BrandController',
        		'display_name'		=> 'Quản lý thương hiệu'
        	],
        	[
        		'controller_name'	=> 'ProductController',
        		'display_name'		=> 'Quản lý sản phẩm'
        	],
        	[
        		'controller_name'	=> 'SupplierController',
        		'display_name'		=> 'Quản lý nhà cung cấp'
        	]
        ]);
    }
}
