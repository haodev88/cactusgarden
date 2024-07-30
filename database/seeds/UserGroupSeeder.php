<?php

use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('user_groups')->insert([
        	[
        		'name'			=> 'Kế toán',
        		'created_at'	=> new DateTime(),
        		'updated_at'	=> new DateTime()
        	],
        	[
        		'name'			=> 'Thu mua',
        		'created_at'	=> new DateTime(),
        		'updated_at'	=> new DateTime()
        	],
        	[
        		'name'			=> 'Marketing',
        		'created_at'	=> new DateTime(),
        		'updated_at'	=> new DateTime()
        	]
        ]);
    }
}
