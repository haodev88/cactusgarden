<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('dt_orders')->insert([
            [
                'dt_order_status_id' => 1,
                'dt_customer_id'     => 1,
                'order_code'         => '1234',
                'order_note'         => 'test node',
                'total_amount'       => '100000',
                'fee_shipping'       => '30000',
                'created_at'         => new DateTime(),
                'updated_at'         => new DateTime(),
            ],
            [
                'dt_order_status_id' => 1,
                'dt_customer_id'     => 2,
                'order_code'         => '5678',
                'order_note'         => 'test node',
                'total_amount'       => '100000',
                'fee_shipping'       => '30000',
                'created_at'         => new DateTime(),
                'updated_at'         => new DateTime(),
            ],
            [
                'dt_order_status_id' => 1,
                'dt_customer_id'     => 1,
                'order_code'         => '0123',
                'order_note'         => 'test node',
                'total_amount'       => '100000',
                'fee_shipping'       => '30000',
                'created_at'         => new DateTime(),
                'updated_at'         => new DateTime(),
            ],
        ]);


        DB::table('dt_order_details')->insert([
            [
                'dt_order_id' => 1,
                'dt_brand_id' => 1,
                'dt_supplier_id' => 1,
                'dt_product_id' => 1,
                'product_name' => 'Áo thun nam',
                'sku'          => 'TT01',
                'quanlity' => 1,
                'price'    => '200000',
                'attribute' => 'Màu Vàng, size S',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'dt_order_id' => 1,
                'dt_brand_id' => 2,
                'dt_supplier_id' => 2,
                'dt_product_id' => 2,
                'sku'          => 'TT02',
                'product_name' => 'Áo thun nữ',
                'quanlity' => 1,
                'price'    => '300000',
                'attribute' => 'Màu Đen, size S',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ]);

    }
}
