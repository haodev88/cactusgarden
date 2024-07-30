<?php

use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('actions')->insert([
        	[
        		'controller_id' => 1,
        		'action_name'	=> 'add',
        		'display_name'	=> 'Thêm'
        	],
        	[
        		'controller_id' => 1,
        		'action_name'	=> 'edit',
        		'display_name'	=> 'sửa'
        	],
        	[
        		'controller_id' => 1,
        		'action_name'	=> 'delete',
        		'display_name'	=> 'xóa'
        	],
        ]);
    }
}
