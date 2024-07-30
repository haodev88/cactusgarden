<?php

use Illuminate\Database\Seeder;

class BuyerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('dt_buyers')->insert([
        	[
        		'name'		=> 'hao.tran',
        		'address'	=> 'PHC',
        		'dt_provinceid'=>79,
        		'dt_districtid'=>774,
        		'dt_wardid'=>27310,
        		'email'		=> 'haotran@gmail.com',
        		'phone'		=> '01254138820'
        	],
        	[
        		'name'		=> 'walace.hao',
        		'email'		=> 'walace@gmail.com',
        		'address'	=> 'PHC',
        		'dt_provinceid'=>79,
        		'dt_districtid'=>774,
        		'dt_wardid'=>27310,
        		'phone'		=> '01254138820'
        	]
        ]);
    }
}
