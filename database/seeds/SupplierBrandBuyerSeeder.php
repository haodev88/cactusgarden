<?php

use Illuminate\Database\Seeder;

class SupplierBrandBuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dt_supplier_brand_buyer')->insert([
        	[
        		'dt_supplier_id'=>1,
        		'dt_brand_id'	=>1,
        	],
        	[
        		'dt_supplier_id'=>2,
        		'dt_brand_id'	=>2,
        	],
        ]);
    }
}
