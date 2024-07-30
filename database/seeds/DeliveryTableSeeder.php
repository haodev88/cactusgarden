<?php

use Illuminate\Database\Seeder;

class DeliveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('dt_order_delivery')->insert([
            [
                'dt_order_id'=>1,
                'dt_provinceid_from'=>1,
                'dt_districtid_from'=>1,
                'dt_wardid_from'=>1,
                'name_delivery_from' =>'Tran vi hao',
                'order_email'        => 'aaa@gmail.com',
                'phone_delivery_from'=>'01254138820',
                'address_from'=>'84 pham huu chi',
                'name_delivery_to'=>'Tran vi hao',
                'phone_delivery_to'=>'01254138820',
                'dt_provinceid_to'=>1,
                'dt_districtid_to'=>1,
                'dt_wardid_to'=>1,
                'address_to'=>'84 pham huu chi'
            ],
            [
                'dt_order_id'=>2,
                'dt_provinceid_from'=>1,
                'dt_districtid_from'=>1,
                'order_email'=> 'bbbb@gmail.com',
                'dt_wardid_from'=>1,
                'name_delivery_from'=>'Tran vi hao',
                'phone_delivery_from'=>'01254138820',
                'address_from'=>'84 pham huu chi',
                'name_delivery_to'=>'Tran vi hao',
                'phone_delivery_to'=>'01254138820',
                'dt_provinceid_to'=>1,
                'dt_districtid_to'=>1,
                'dt_wardid_to'=>1,
                'address_to'=>'84 pham huu chi'
            ]
        ]);
    }
}
