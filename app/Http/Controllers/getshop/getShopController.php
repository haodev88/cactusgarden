<?php

namespace App\Http\Controllers\getshop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\DB;

class getShopController extends Controller {

    public function index(Request $request) {
        $input = $request->all();
        if (isset($input['shop'])) {
            switch ($input['shop']) {
                case 'mymall';
                $this->shopMyMall();
                break;

                case 'orchardvn';
                $this->shopOrchardVn();
                break;

            }
        }
    }

    protected function shopMyMall() {
        $resizeProduct = Config('global.size_product');
        $path          = '17/01/03';
        $uploadDir     = 'uploads/mains/'.$path.'/';
        $resizeDir     = 'uploads/mains/'.$path.'/thumbs/';

        $source    = file_get_html('https://mymall.vn/gia-dung/thiet-bi-gia-dinh/quat-dien/treo-tran/');
        $images    = $source->find('div.catalog-list img');
        $name      = $source->find('div.catalog-list h3.title');
        $priceOld  = $source->find('div.catalog-list span.price-sale');
        $sttSku = 0;
        $data   = [];
        ini_set('memory_limit', '-1');
        for ($i=0;$i<count($images);$i++) {
            $sttSku++;
            $title         = $name[$i]->plaintext;
            $img           = $images[$i]->getAttribute('data-original');
            $img           = str_replace(['185x185_',' '],['','%20'],$img);
            $priOld        = str_replace(['đ ',',','.'],'',strip_tags($priceOld[$i]->plaintext));
            $newSource     = substr($img,strrpos($img,'/')+1);
            $newSource     = str_replace([',','(',')','%20'],['','','',''],$newSource);
            file_put_contents($uploadDir.$newSource,file_get_contents($img));
            foreach ($resizeProduct as $k => $size) {
                $outputFile = $size[0].'x'.$size[1].'_'.$newSource;
                resizeImage($uploadDir,$resizeDir, $newSource, $outputFile, $size[0], $size[1]);
            }
            $data[] = [
                'dt_category_id'    => 29,
                'dt_brand_id'       => 2,
                'dt_supplier_id'    => 1,
                'user_id'           => 1,
                'sku'               => 'QUATMAYTREOTRAN'.$sttSku,
                'name'              => $title,
                'slug'              => str_slug($title),
                'price'             => $priOld,
                'self_price'        => 0,
                'count'             => 10,
                'default_image'     => $path.'/'.$newSource,
                'filename'          => json_encode([["image"=>$path.'/'.$newSource,"default"=>1]]),
                'short_desc'        => '',
                'long_desc'         => '',
                'active'            => 1,
                'created_at'        => new DateTime(),
                'updated_at'        => new DateTime(),
            ];
        }
        DB::table('dt_products')->insert($data);
        echo 'done';
    }


    protected function shopOrchardVn() {
        die();
        $resizeProduct = Config('global.size_product');
        $path          = '17/01/02';
        $uploadDir     = 'uploads/mains/'.$path.'/';
        $resizeDir     = 'uploads/mains/'.$path.'/thumbs/';
        $source = file_get_html('https://orchard.vn/calvin-klein-ck/?subcats=Y&features_hash=V9795');
        $title  = $source->find('div.product-title-wrap a');
        $image  = $source->find('div.preview-image img');
        $price  = $source->find('.product-price span.price');
        $sttSku = 18;
        ini_set('memory_limit', '-1');
        $data = [];
        set_error_handler(null);
        set_exception_handler(null);
        foreach ($price as $key=>$item) {
            $sttSku++;
            $pri  = str_replace([',',' '],'', $item->find('span.price-num',0)) ;
            $pri  = strip_tags($pri);
            $tit  = $title[$key]->plaintext;
            $img  = substr($image[$key]->src,strrpos($image[$key]->src,'detailed'));
            $img  = str_replace('png','jpg',$img);
            $img  = 'https://orchard.vn/images/'.$img;
            $newSource = substr($image[$key]->src,strrpos($image[$key]->src,'/')+1);
            if (!$translate_feed = file_get_contents($img)) {
                $img = str_replace('jpg','JPG',$img);
            }
            file_put_contents($uploadDir.$newSource,file_get_contents($img));
            foreach ($resizeProduct as $k => $size) {
                $outputFile = $size[0].'x'.$size[1].'_'.$newSource;
                resizeImage($uploadDir,$resizeDir, $newSource, $outputFile, $size[0], $size[1]);
            }

            $data[] = [
                'dt_category_id'    => 24,
                'dt_brand_id'       => 9,
                'dt_supplier_id'    => 1,
                'user_id'           => 1,
                'sku'               => 'NUOCHOANAM'.$sttSku,
                'name'              => $tit,
                'slug'              => str_slug($tit),
                'price'             => $pri,
                'self_price'        => 0,
                'count'             => 10,
                'default_image'     => $path.'/'.$newSource,
                'filename'          => json_encode([["image"=>$path.'/'.$newSource,"default"=>1]]),
                'short_desc'        => '',
                'long_desc'         => '',
                'active'            => 1,
                'created_at'        => new DateTime(),
                'updated_at'        => new DateTime(),
            ];
        }

        DB::table('dt_products')->insert($data);
        echo "done";




    }



}
