<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dt_customers')->insert([
        	[
        		'dt_provinceid'=>79,
        		'dt_districtid'=>774,
        		'dt_wardid'=>27310,
        		'name'=>'Tuấn Hoành',
                'address'=>'Pham huu chi',
        		'email'=>'wongtiu@gmail.com',
				'password'=>bcrypt('12345'),
        		'phone'=>'01254138820',
        		'birthday'=>'2015-31-12',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_provinceid'=>79,
        		'dt_districtid'=>774,
        		'dt_wardid'=>27310,
        		'name'=>'Gia Dung',
                'address'=>'8b võ truong toan',
        		'email'=>'helenyung@gmail.com',
				'password'=>bcrypt('12345'),
        		'phone'=>'01268947161',
        		'birthday'=>'1989-11-14',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_provinceid'=>79,
        		'dt_districtid'=>774,
        		'dt_wardid'=>27310,
        		'name'=>'Bảo Nhi',
                'address'=>'8b võ truong toan',
        		'email'=>'vuongnhi@gmail.com',
				'password'=>bcrypt('12345'),
        		'phone'=>'01268947161',
        		'birthday'=>'1992-07-30',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        	[
        		'dt_provinceid'=>79,
        		'dt_districtid'=>774,
        		'dt_wardid'=>27310,
        		'name'=>'Bảo Trân',
                'address'=>'8b võ truong toan',
        		'email'=>'baotran@gmail.com',
				'password'=>bcrypt('12345'),
        		'phone'=>'01268947161',
        		'birthday'=>'1995-05-25',
        		'created_at'=>new DateTime(),
        		'updated_at'=>new DateTime()
        	],
        ]);
    }
}
