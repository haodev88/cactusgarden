@extends('cactus._include.master')
@section('title_page', $cate["slug"])
@section('content')
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <!--Shop Area Start-->
    <div class="shop-area pb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">

                    <!--Price Filter Widget Start-->
                    <form action="" method="get">
                        <div class="shop-sidebar">
                            <h4>Lọc theo giá</h4>
                            <div class="price-filter">
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="label-input">
                                        <input style="width: 95px;" name="price_from" type="text" id="price_from" placeholder="Từ" />
                                        <input style="width: 95px;" name="price_to" type="text" id="price_to" placeholder="Đến" />
                                    </div>
                                    <button type="submit">Lọc</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--Price Filter Widget End-->

                    @if(isset($discountProduct) && $discountProduct->count()!=0)
                        <!--Recent Product Widget Start-->
                        <div class="shop-sidebar">
                            <h4>Sản phẩm giá tốt</h4>
                            <div class="rc-product">
                                <ul>
                                    @foreach($discountProduct as $_item)
                                        {!! templateRated($_item) !!}
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--Recent Product Widget End-->
                    @endif

                <!--Recent Product Widget Start-->
                    <div class="shop-sidebar">
                        <h4>Bài viết</h4>
                        <div class="rc-product">
                            <ul>
                                @foreach ($blog as $_blog)
                                <li>
                                    <div class="rc-product-thumb img-full">
                                        <a href="{{ route("blog-detail",["alias"=>$_blog->slug, "id"=>$_blog->id]) }}">
                                            <img src="{{ URL::to("/").Config("global.root_media")."blogs/".$_blog->image }}" alt="">
                                        </a>
                                    </div>
                                    <div class="rc-product-content">
                                        <h6><a href="{{ route("blog-detail",["alias"=>$_blog->slug, "id"=>$_blog->id]) }}">{{ $_blog->title }}</a></h6>
                                        <div class="" style="margin: 0">
                                            <span class="">{{ $_blog->author }}</span>
                                        </div>
                                    </div>

                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--Recent Product Widget End-->

                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-layout">
                        <!--Grid & List View Start-->
                        <div class="shop-topbar-wrapper d-md-flex justify-content-md-between align-items-center">
                            <div class="grid-list-option">
                            </div>
                            <!--Toolbar Short Area Start-->
                            <form name="sort-by" id="sort-by" method="get" action="{{ $sortAction }}">
                                <div class="toolbar-short-area d-md-flex align-items-center">
                                    <div class="toolbar-shorter">
                                        <select id="sort_by" name="sort_by" class="wide" style="display: none;">
                                            <option>Chọn</option>
                                            @if($sortValue != null)
                                                <option value="">Bỏ chọn</option>
                                            @endif
                                            @foreach($sortOptions as $name => $_item)
                                                @if(isset($params["sort_by"]) && $params["sort_by"] == $name)
                                                    <option selected data-display="Select" value="{{ $name }}">{{ $_item }}</option>
                                                @else
                                                    <option value="{{ $name }}">{{ $_item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="nice-select wide" tabindex="0">
                                            <span class="current">{{ $sortValue!=null ? $sortValue : 'Chọn' }}</span>
                                            <ul class="list">
                                                @if($sortValue != null)
                                                    <li data-value="" class="option">Bỏ chọn</li>
                                                @endif
                                                @foreach($sortOptions as $name => $_item)
                                                    @if(isset($params["sort_by"]) && $params["sort_by"] == $name)
                                                        <li data-display="Select" data-value="{{ $name }}" class="option selected">{{ $_item }}</li>
                                                    @else
                                                        <li data-value="{{ $name }}" class="option">{{ $_item }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($append) && !empty($append))
                                    @foreach ($append as $name=>$_item)
                                        @if($name!="sort_by")
                                            <input type="hidden" name="{{ $name }}" value="{{ $_item }}" />
                                        @endif
                                    @endforeach
                                @endif
                            </form>
                            <!--Toolbar Short Area End-->
                        </div>
                        <!--Grid & List View End-->
                        <!--Shop Product Start-->
                        <div class="shop-product">
                            <div id="myTabContent-2" class="tab-content">
                                <div id="grid" class="tab-pane fade show active">
                                    <div class="product-grid-view">
                                        <div class="row">
                                            @if ($listProduct->count()!=0)
                                                @foreach ($listProduct as $_item)
                                                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6">
                                                        <!--Single Product Area Start-->
                                                        {!! templateProductItem($_item) !!}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!--Pagination Start-->
                                @if(isset($append) && !empty($append))
                                    @include('cactus._include.paginate', ['paginator' => $listProduct->appends($append)]);
                                @else
                                    @include('cactus._include.paginate', ['paginator' => $listProduct])
                                @endif
                                <!--Pagination End-->
                            </div>
                        </div>
                        <!--Shop Product End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Shop Area End-->

    @foreach ($listProduct as $_item)
        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6">
            <!--Single Product Area Start-->
            {!! templateModalProduct($_item) !!}
        </div>
    @endforeach
@endsection

@section('js_before')
    <script type="text/javascript">
        var priceFrom = "<?php echo isset($params["price_from"]) ? $params["price_from"] : null; ?>";
        var priceTo = "<?php echo isset($params["price_to"]) ? $params["price_to"] : null; ?>";
    </script>
@endsection

@section("js")
    <script type="text/javascript">
        $(function() {
            $("a.quick-view").on("click", function () {
                var id = $(this).attr("data-id");
                $("div.modal-product-"+id).modal();
            });

            $("select#sort_by").on("change", function () {
                $("form[name=sort-by]").submit();
            });
        });
    </script>
@endsection
