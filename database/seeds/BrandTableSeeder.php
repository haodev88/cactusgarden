<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert  into `dt_brands`(`id`,`user_id`,`name`,`slug`,`filename`,`short_desc`,`long_desc`,`active`,`created_at`,`updated_at`) values (1,2,\'Samsung\',\'samsung\',\'16/10/23/1477236471_brand3.png\',\'<p>M&ocirc; tả ngắn</p>\r\n\',\'<p>M&ocirc; tả d&agrave;i</p>\r\n\',1,\'2016-10-23 07:06:21\',\'2016-10-23 15:27:51\'),(2,2,\'Nokia\',\'nokia\',\'16/10/23/1477236464_brand1.png\',\'<p>M&ocirc; tả ngắn</p>\r\n\',\'<p>M&ocirc; tả d&agrave;i</p>\r\n\',1,\'2016-10-23 07:06:21\',\'2016-10-23 15:27:44\'),(3,2,\'Apple\',\'apple\',\'16/10/23/1477236457_brand4.png\',\'<p>M&ocirc; tả ngắn</p>\r\n\',\'<p>M&ocirc; tả d&agrave;i</p>\r\n\',1,\'2016-10-23 07:06:21\',\'2016-10-23 15:27:37\'),(4,2,\'HTC\',\'htc\',\'16/10/23/1477236450_brand5.png\',\'<p>M&ocirc; tả ngắn</p>\r\n\',\'<p>M&ocirc; tả d&agrave;i</p>\r\n\',1,\'2016-10-23 07:06:21\',\'2016-10-23 15:27:30\'),(5,2,\'LG\',\'lg\',\'16/10/23/1477236444_brand6.png\',\'\',\'\',1,\'2016-10-23 15:23:34\',\'2016-10-23 15:27:24\'),(6,2,\'OPPO\',\'oppo\',\'16/11/14/1479085509_oppo-logo.jpg\',\'\',\'\',1,\'2016-11-14 01:05:09\',\'2016-11-14 01:05:09\');
');
    }
}
