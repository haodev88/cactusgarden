<?php

    /** For Template shop cactus */
    function headerCart() {
        $html = '<li class="single-cart-item">
            <div class="cart-img">
                <a href="{LINK}"><img src="{IMAGE}" alt=""></a>
            </div>
            <div class="cart-content">
                <h5 class="product-name"><a href="">{NAME}</a></h5>
                <span class="product-quantity">{QUANTIY} ×</span>
                <span class="product-price">{PRICE}</span>
            </div>
            <div class="cart-item-remove">
                <a data-rel="{KEY}" class="remove_item" title="Remove" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
            </div>
        </li>';
        return $html;
    }

    // template price
    function templatePrice($_item) {
        $tem = '';
        if ($_item["self_price"]!=0) {
            $tem.='<span class="now-price">'.currentPriceFormat($_item["self_price"]).'</span>';
            $tem.='<span class="regular-price">'.currentPriceFormat($_item["price"]).'</span>';
        } else {
            $tem.='<span class="now-price">'.currentPriceFormat($_item["price"]).'</span>';
        }
        return $tem;
    }

    // template product action
    function templateProductAction($_item) {
       $html = '<ul><li>';
       $html.= Form::open(['route'=>'add-cart','class'=>'frmAddCart', 'name'=>'frmAddCart','method'=>'post']);
       $html.= '<input min="1" max="30" name="number" type="hidden" value="1">';
       $html.= '<input name="id" type="hidden" value="'.$_item["id"].'">';
       $html.= '<button style="display: none;" class="add-cart" data-text="add to cart">Thêm giỏ hàng</button>';
       $html.= Form::close();
       $html.='<a onclick="$(this).closest(\'li\').find(\'button\').click();" href="javascript:void(0);" title="Thêm vào giỏ hàng"><span class="icon_bag_alt"></span></a>';
       $html.= '</li></ul>';
       return $html;
    }

    function templateProductItem($_item) {
        $img = sizeOfFileName(asset('uploads/mains/'.$_item['default_image']),'600x600');
        $_item['default_image'] = $img['path'].$img['filename'];
        return '
        <div class="single-product-area mb-40">
            <div class="product-img img-full">
                <a href="javascript:void(0);">
                    <img class="first-img" src="'.$img['path'].$img['filename'].'" alt="'.$img['filename'].'">
                </a>
                <span class="sticker" style="display: none;">Mới</span>
                <div class="product-action">
                    '.templateProductAction($_item).'
                </div>
                <ul class="product-quickview">
                    <li><a href="javascript:void(0);" data-id="'.$_item["id"].'" class="quick-view" title="Quick View"><span class="icon_search"></span></a></li>
                </ul>
            </div>
            <div class="product-content">
                <h4><a href="'.Route("detail", ["id"=>$_item["id"], "alias"=>$_item["slug"]]).'">'.$_item["name"].'</a></h4>
                <div class="product-price">
                    '.templatePrice($_item).'
                </div>
            </div>
        </div>
        <!--Single Product Area End-->
        <div class="text-hide data-product-'.$_item["id"].'">
            '.Response()->json($_item)->getContent().'
        </div>';
    }

    function templateModalProduct($_item) {
        $imgList = json_decode($_item["filename"], true);
        $tem ='<div class="modal fade modal-product-'.$_item["id"].'" id="open-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!--Modal Img-->
                            <div class="col-md-5">
                                <!--Modal Tab Content Start-->
                                <div class="tab-content product-details-large" id="myTabContent">';
                                    foreach ($imgList as $k=>$_image) {
                                        $classActive = ($k == 0) ? ' active' : '';
                                        $tem.='<div class="tab-pane fade show'.$classActive.'" id="single-slide'.$k.'" role="tabpanel" aria-labelledby="single-slide-tab-'.$k.'}}">
                                            <!--Single Product Image Start-->
                                            <div class="single-product-img img-full default-image">
                                                <img src="'.URL::to("/").Config('global.media_url').$_image["image"].'" alt="">
                                            </div>
                                            <!--Single Product Image End-->
                                        </div>';
                                    }
                                $tem.='</div>';
                                if (count($imgList) > 1) :
                                    $tem.='
                                    <div class="single-product-menu">
                                        <div class="nav single-slide-menu owl-carousel" role="tablist" id="tablist-'.$_item['id'].'">';
                                            foreach ($imgList as $k=>$_image) {
                                                $classActive = ($k == 0) ? 'active' : '';
                                                $tem.='
                                                <div class="single-tab-menu img-full carousel-img">
                                                     <a class="'.$classActive.'" data-toggle="tab" id="single-slide-tab-'.$k.'" href="#single-slide'.$k.'">
                                                        <img src="'.URL::to("/").Config('global.media_url').$_image["image"].'" alt="">
                                                    </a>
                                                </div>';
                                            }
                                        $tem.='</div>
                                    </div>
                                <!--Modal Tab Menu End-->';
                                endif;
                            $tem.=
                            '</div>
                            <!--Modal Img-->
                            <!--Modal Content-->

                            <div class="col-md-7">
                                <div class="modal-product-info">
                                    '.Form::open(['route'=>'add-cart','class'=>'frmAddCart', 'name'=>'frmAddCart','method'=>'post']).'
                                    <h1>'.$_item["name"].'</h1>
                                    <div class="modal-product-price">
                                        '.templatePrice($_item).'
                                    </div>
                                    <a href="'.Route("detail", ["id"=>$_item["id"], "alias"=>$_item["slug"]]).'" class="see-all">Xem chi tiết</a>
                                    <div class="add-to-cart quantity">
                                        <div class="modal-quantity">
                                            <input min="1" max="30" name="number" type="number" value="1">
                                        </div>
                                        <div class="add-to-link">
                                            <button class="form-button add-cart" data-text="add to cart">Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                    <div class="cart-description">
                                        '.$_item["short_desc"].'
                                    </div>
                                    '.Form::hidden("id", $_item["id"]).'
                                    '.Form::close().'
                                </div>
                            </div>
                            <!--Modal Content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        return $tem;
    }

    function templateRated($_item) {
        $tem =
        '<li>
            <div class="rc-product-thumb img-full">
                <a href="'.route("detail",["slug"=>$_item["slug"],"id"=>$_item["id"]]).'"><img src="'.URL::to("/").Config('global.media_url').$_item['default_image'].'" alt=""></a>
            </div>
            <div class="rc-product-content">
                <h6><a href="'.route("detail",["slug"=>$_item["slug"],"id"=>$_item["id"]]).'">'.$_item["name"].'</a></h6>
                <div class="product-price">
                    <span class="now-price">'.currentPriceFormat($_item['self_price']).'</span>
                    <span class="regular-price">'.currentPriceFormat($_item['price']).'</span>
                </div>
            </div>
        </li>';
        return $tem;
    }

    function templateBreadcrumb($items, $title) {
        $template = '<div class="breadcrumb-bg">
            <ul class="breadcrumb-menu">';
            foreach ($items as $_item) {
                if ($_item["url"]!="") {
                    $template.='<li><a href="'.$_item["url"].'">'.$_item["label"].'</a></li>';
                } else {
                    $template.='<li>'.$_item["label"].'</li>';
                }
            }

        $template.='</ul>
            <h2>'.$title.'</h2>
        </div>';
        return $template;
    }

    function templateCart() {
        $html = '<tr>
            <td class="indecor-product-thumbnail"><a href="{LINK}"><img src="{SRC}" alt=""></a></td>
            <td class="indecor-product-name"><a href="#">{NAME}</a></td>
            <td class="indecor-product-price"><span class="amount">{PRICE}</span></td>
            <td class="indecor-product-quantity">
                <form method="POST" action="javascript:void(0);" accept-charset="UTF-8" name="">
                    <input type="hidden" name="_token" value="{TOKEN}">
                    <input type="hidden" name="id" value="{ID}">
                    <input type="hidden" name="keyCart" value="{KEY}">
                    <input value="{QUANLITY}" type="number" name="qty" maxlength="3" max="100" min="1">
                    &nbsp;<a onclick="$(this).next().click();" href="javascript:void(0);"><i class="fa fa-refresh" aria-hidden="true"></i></a>&nbsp;
                    <button style="display: none;" type="submit" class="update-qty">Cập nhật</button>

                </form>
            </td>
            <td class="product-subtotal">
                <span class="amount">{TOTAL_PRICE}</span>
            </td>
            <td class="indecor-product-remove">
                <a data-rel="{REL}" class="remove_item remove-cart-item" href="javascript:void(0);"><i class="fa fa-times"></i></a>
            </td>
        </tr>';
        return $html;
    }

?>
