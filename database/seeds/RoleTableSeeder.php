<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	DB::table('roles')->insert([
    		[
    			'name'				=>	'Admin',
    			'display_name'		=>	'Administrator',
    			'description'		=>  'admin',
    			'created_at'		=>   new DateTime(),
    			'updated_at'		=>	 new DateTime()
    		],
    		[
    			'name'				=>	'Owner',
    			'display_name'		=>	'Project Owner',
    			'description'		=>  'Owner',
    			'created_at'		=>   new DateTime(),
    			'updated_at'		=>	 new DateTime()
    		],
    		[
    			'name'				=>	'Employee',
    			'display_name'		=>	'Widget Co. Employee',
    			'description'		=>  'employee',
    			'created_at'		=>   new DateTime(),
    			'updated_at'		=>	 new DateTime()
    		]
    	]);
    }
}
