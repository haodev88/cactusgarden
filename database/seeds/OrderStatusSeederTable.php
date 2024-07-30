<?php

use Illuminate\Database\Seeder;

class OrderStatusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('dt_order_status')->insert([
            [
                'name'          =>  'Đặt hàng thành công',
                'html_tracking' =>  '
                <li>
                <a href="#step-1" class="selected">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                     Bước 1 <br>
                    <small>Đặt hàng thành công</small>
                  </span>
                </a>
                </li>
                <li>
                <a href="" class="disabled">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                     Bước 2 <br>
                    <small>Xác nhận đơn hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-3" class="disabled">
                    <span class="step_no">3</span>
                    <span class="step_descr">
                    Bước 3 <br>
                    <small>Đi giao hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-4" class="disabled">
                    <span class="step_no">4</span>
                    <span class="step_descr">
                    Bước 4<br>
                    <small>Giao hàng thành công</small>
                    </span>
                </a>
                </li>'
            ],
            [
                'name'          =>  'Xác nhận đơn hàng',
                'html_tracking' =>  '
                <li>
                <a href="#step-1" class="selected">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                     Bước 1 <br>
                    <small>Đặt hàng thành công</small>
                  </span>
                </a>
                </li>
                <li>
                <a href="" class="selected">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                     Bước 2 <br>
                    <small>Xác nhận đơn hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-3" class="disabled">
                    <span class="step_no">3</span>
                    <span class="step_descr">
                    Bước 3 <br>
                    <small>Đi giao hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-4" class="disabled">
                    <span class="step_no">4</span>
                    <span class="step_descr">
                    Bước 4<br>
                    <small>Giao hàng thành công</small>
                    </span>
                </a>
                </li>'
            ],
            [
                'name'             => 'Đi giao hàng',
                'html_tracking'    =>
                '<li>
                <a href="#step-1" class="selected">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                     Bước 1 <br>
                    <small>Đặt hàng thành công</small>
                  </span>
                </a>
                </li>
                <li>
                <a href="" class="selected">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                     Bước 2 <br>
                    <small>Xác nhận đơn hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-3" class="selected">
                    <span class="step_no">3</span>
                    <span class="step_descr">
                    Bước 3 <br>
                    <small>Đi giao hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-4" class="disabled">
                    <span class="step_no">4</span>
                    <span class="step_descr">
                    Bước 4<br>
                    <small>Giao hàng thành công</small>
                    </span>
                </a>
                </li>'
            ],
            [
                'name'          => 'Giao hàng thành công',
                'html_tracking' => '
                <li>
                <a href="#step-1" class="selected">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                     Bước 1 <br>
                    <small>Đặt hàng thành công</small>
                  </span>
                </a>
                </li>
                <li>
                <a href="" class="selected">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                     Bước 2 <br>
                    <small>Xác nhận đơn hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-3" class="selected">
                    <span class="step_no">3</span>
                    <span class="step_descr">
                    Bước 3 <br>
                    <small>Đi giao hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-4" class="selected">
                    <span class="step_no">4</span>
                    <span class="step_descr">
                    Bước 4<br>
                    <small>Giao hàng thành công</small>
                    </span>
                </a>
                </li>'
            ],
            [
                'name'          => 'Hủy Đơn hàng',
                'html_tracking' => '
                <li>
                <a href="#step-1" class="selected">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                     Bước 1 <br>
                    <small>Đặt hàng thành công</small>
                  </span>
                </a>
                </li>
                <li>
                <a href="" class="disabled">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                     Bước 2 <br>
                    <small>Xác nhận đơn hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-3" class="disabled">
                    <span class="step_no">3</span>
                    <span class="step_descr">
                    Bước 3 <br>
                    <small>Đi giao hàng</small>
                    </span>
                </a>
                </li>
                <li>
                <a href="#step-4" class="disabled">
                    <span class="step_no">4</span>
                    <span class="step_descr">
                    Bước 4<br>
                    <small>Giao hàng thành công</small>
                    </span>
                </a>
                </li>'
            ]
        ]);
    }
}
