@extends('cactus._include.master')
@section('title_page', $itemProduct->slug)
@section('og')
    <meta property="og:image" content="{{ URL::to("/")."/".Config('global.media_url').$itemProduct->default_image }}" />
@endsection
@section('content')
    <style type="text/css">
        .breadcrumb-bg {
            background-image : url("{{ $breadcrumb["bg"] }}");
        }
    </style>
    <!--Breadcrumb Area Start-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <!--Single Product Area Start-->
    <div class="single-product-area pb-70">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-lg-image-1">
                            <?php $listImg = json_decode($itemProduct->filename, true); ?>
                            @foreach ($listImg as $_item)
                                <?php $fileSmall = sizeOfFileName($_item["image"],'600x600'); ?>
                                <div class="lg-image">
                                    <div class="easyzoom easyzoom--overlay">
                                        <a href="{{ URL::to("/").Config('global.media_url').$_item["image"] }}">
                                            <img src="{{  URL::to("/").Config('global.media_url').$fileSmall['path'].$fileSmall['filename'] }}" alt="">
                                        </a>
                                        <a href="{{ URL::to("/").Config('global.media_url').$_item["image"] }}" class="popup-img venobox" data-gall="myGallery"><i class="fa fa-expand"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if(count($listImg) > 1)
                            <div class="product-details-thumbs slider-thumbs-1">
                                @foreach ($listImg as $_item)
                                    <?php $fileSmall = sizeOfFileName($_item["image"],'600x600'); ?>
                                    <div class="sm-image"><img src="{{ URL::to("/").Config('global.media_url').$fileSmall["path"].$fileSmall["filename"] }}" alt="product image thumb"></div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <!--Product Details Left -->
                    <!--Product Details Left -->
                </div>
                <div class="col-md-12 col-lg-6">
                    <!--Product Details Content Start-->
                    <div class="product-details-content">

                        <h3>{{ $itemProduct->name }}</h3>

                        <div class="single-product-price">
                            {!! templatePrice($itemProduct) !!}
                        </div>

                        <div class="product-description">
                            {!! $itemProduct->short_desc !!}
                        </div>
                        <div class="single-product-quantity">
                            {{ Form::open(['route'=>'add-cart','class'=>'frmAddCart', 'name'=>'frmAddCart','method'=>'post']) }}
                                <div class="product-quantity">
                                    <input min="1" max="30" name="number" type="number" value="1" />
                                </div>
                                <div class="add-to-link">
                                    <button class="product-btn cart add-cart" data-text="add to cart">Thêm giỏ hàng</button>
                                </div>

                            {{ Form::hidden("id",$itemProduct->id) }}
                            {{ Form::close() }}
                        </div>
                        <div class="product-meta">
                            <span class="posted-in">
                                Danh mục:
                                <a href="#">{{ $itemProduct->category->title }}</a>
                            </span>
                        </div>
                        <div class="single-product-sharing">
                            <h3>Chia Sẻ</h3>
                            <ul>
                                <li>
                                    <div class="addthis_toolbox addthis_default_style" data-url="{{ route("detail",["id"=>$itemProduct->id, "alias"=>$itemProduct->slug]) }}">
                                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                        <a class="addthis_counter addthis_pill_style"></a>
                                    </div>
                                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dbbbff7dbae3a27"></script>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Product Details Content End-->
                </div>
            </div>
        </div>
    </div>
    <!--Single Product Area End-->

    <!--Product Description Review Area Start-->
    <div class="product-description-review-area pb-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-review-tab">
                        <!--Review And Description Tab Menu Start-->
                        <ul class="nav dec-and-review-menu">
                            <li>
                                <a class="active" data-toggle="tab" href="#description">Mô tả</a>
                            </li>
                        </ul>
                        <!--Review And Description Tab Menu End-->
                        <!--Review And Description Tab Content Start-->
                        <div class="tab-content product-review-content-tab" id="myTabContent-4">
                            <div class="tab-pane fade active show" id="description">
                                <div class="single-product-description">
                                    <h2>Mô tả</h2>
                                    {!! $itemProduct->long_desc !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Review And Description Tab Content End-->
                </div>
            </div>
        </div>
    </div>
    <!--Product Description Review Area Start-->
    <!--Related Products Area Start-->
    <div class="related-products-area pb-35">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--Section Title 2 Start-->
                    <div class="section-title2">
                        <h2>Sản phẩm cùng danh mục</h2>
                    </div>
                    <!--Section Title 2 End-->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="product-slider owl-carousel">
                            @foreach ($ProductSameCate as $_item)
                            <div class="col-md-12">
                                <!--Single Product Area Start-->
                                {!! templateProductItem($_item) !!}
                                <!--Single Product Area End-->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--New Product Area End-->

    <!-- Modal Area Strat -->
    @foreach ($ProductSameCate as $_item)
        {!! templateModalProduct($_item) !!}
        <!-- Modal Area End -->
    @endforeach
    <!--/ Modal Area Strat -->

@endsection

@section("js")
    <script type="text/javascript">
        $(function() {
            $("a.quick-view").on("click", function () {
                var id = $(this).attr("data-id");
                $("div.modal-product-"+id).modal();
            });
        });
    </script>
@endsection
