<?php

use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::insert(
            '
              insert  into `dt_banners`(`id`,`banner_position_id`,`source`,`link`,`created_at`,`updated_at`) values (4,1,\'1482061990_148169916542.jpg\',\'http://www.google.com.vn\',\'2016-12-18 11:53:10\',\'2016-12-18 11:53:10\'),(5,1,\'1482061990_148177809582.jpg\',\'http://www.youtube.com\',\'2016-12-18 11:53:10\',\'2016-12-18 11:53:10\');
            '
        );
    }
}
