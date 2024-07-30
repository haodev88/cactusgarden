<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'username'	 => 'sup-admin',
        		'email'		 => 'sup-admin@gmail.com',
                'name'       => 'Supper admin',
        		'password'   => bcrypt('12345'),
				'avatar'	 => '16/10/20/1476972629_1475973854_cu_meo.png',
        		'created_at' => new DateTime()
        	],
        	[
        		'username'	 => 'admin',
        		'email'		 => 'admin@gmail.com',
                'name'       => 'Admin',
        		'password'   => bcrypt('12345'),
				'avatar'	 => '16/10/20/1476972629_1475973854_cu_meo.png',
        		'created_at' => new DateTime()
        	],
        	[
        		'username'	 => 'member',
        		'email'		 => 'member@gmail.com',
        		'password'   => bcrypt('12345'),
                'name'       => 'Member',
				'avatar'	 => '16/10/20/1476972629_1475973854_cu_meo.png',
        		'created_at' => new DateTime()
        	],
        	[
        		'username'	 => 'user',
        		'email'		 => 'user@gmail.com',
                'name'       => 'user',
				'avatar'	 => '16/09/22/1474564423_img.jpg',
        		'password'   => bcrypt('12345'),
        		'created_at' => new DateTime()
        	]
        ]);
    }
}
