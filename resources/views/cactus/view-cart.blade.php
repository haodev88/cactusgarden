@extends('cactus._include.master')
@section('title_page', "Giỏ hàng")
@section('content')
    <!--Breadcrumb Area Start-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (isset($listCart) && !empty($listCart))
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="indecor-product-thumbnail">Ảnh sản phẩm</th>
                                    <th class="cart-product-name">Tên Sản phẩm</th>
                                    <th class="indecor-product-price">Giá</th>
                                    <th class="indecor-product-quantity">Số lượng</th>
                                    <th class="indecor-product-subtotal">Tổng tiền</th>
                                    <th class="indecor-product-remove">Xóa</th>
                                </tr>
                                </thead>
                                <tbody id="cart-items">
                                    <?php $total = 0; ?>
                                    @foreach($listCart as $key=>$item)
                                        <?php $img = sizeOfFileName(asset('uploads/mains/'.$item["default_image"]),'80x80'); ?>
                                        <?php
                                            $templateCart = templateCart();
                                            $templateCart = str_replace('{SRC}',$img['path'].$img['filename'],$templateCart);
                                            $templateCart = str_replace('{LINK}',route('detail',['id'=>$item['id'],'alias'=>$item['slug']]),$templateCart);
                                            $templateCart = str_replace('{NAME}',$item['name'],$templateCart);
                                            $templateCart = str_replace('{BRAND_NAME}',$item['brand_name'],$templateCart);
                                            $templateCart = (isset($item['size']) && $item['size']!='')   ? str_replace('{SIZE}','| '.$item['size'],$templateCart) :str_replace('{SIZE}','',$templateCart);
                                            $templateCart = (isset($item['color']) && $item['color']!='') ? str_replace('{COLOR}','| '.$item['color'],$templateCart) :str_replace('{COLOR}','',$templateCart) ;
                                            $templateCart = str_replace('{PRICE}',currentPriceFormat($item["price"]),$templateCart);
                                            $templateCart = str_replace('{TOTAL_PRICE}',currentPriceFormat($item["price"]*$item["quanlity"]),$templateCart);
                                            $templateCart = str_replace('{ACTION}',route('update-cart'),$templateCart);
                                            $templateCart = str_replace('{TOKEN}',csrf_token(),$templateCart);
                                            $templateCart = str_replace('{ID}',$item['id'],$templateCart);
                                            $templateCart = str_replace('{KEY}',$key,$templateCart);
                                            $templateCart = str_replace('{QUANLITY}',$item['quanlity'],$templateCart);
                                            $templateCart = str_replace('{REL}', $key,$templateCart);
                                            $total+=$item["price"]*$item["quanlity"];
                                            echo $templateCart;
                                        ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <ul>
                                        <li>Tổng tiền <span id="total-cart">{!! currentPriceFormat($total) !!}</span></li>
                                    </ul>
                                    <a href="{{ route("order-infomation") }}">Tiến hành mua hàng</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            Quý khách chưa có sản phẩm trong giỏ hàng. Quý khách hãy dạo cửa hàng và chọn những sản phẩm ưa thích nhé. Kính chúc quý khách một ngày an lành.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->
@endsection

@section("js")
    <script id="template-cart" type="text/x-handlebars-template">
         {!! templateCart() !!}
    </script>
@endsection
