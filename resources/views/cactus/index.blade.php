@extends('cactus._include.master')
@section('title_page', 'Trang chủ')
@section('content')
    @if($slider->count() > 0)
        <!--Slider Area Start-->
        <div class="slider-area">
            <div class="hero-slider owl-carousel">
                @foreach ($slider as $k=>$_item)
                    @if($_item['banner_position_id'] == 1)
                        <!--Single Slider Start-->
                        <div class="single-slider" style="background-image: url({{ URL::to("/")."/".$path."banners/".$_item->source }})"></div>
                        <!--Single Slider End-->
                        <?php unset($slider[$k]) ?>
                    @endif
                @endforeach
            </div>
        </div>
        <!--Slider Area End-->
    @endif

    @if($slider->count() > 0)
        @foreach ($slider as $k=>$_item)
            @if ($_item["banner_position_id"] == 2)
                <!--Feature Area Start-->
                <div class="feature-area pt-35 pb-50 text-center">
                    <img alt="{{ $_item->source }}" src="{{ URL::to("/")."/".$path."banners/".$_item->source }}" />
                    {!! $_item->desc !!}
                </div>
                <!--Feature Area End-->
                <?php unset($slider[$k]) ?>
            @endif
        @endforeach
    @endif

    @if($slider->count() > 0)
        <!--Our Collection Area Start-->
        <div class="our-collection-area collection-bg pb-75">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!--Section Title Start-->
                        <div class="section-title">
                            <h2>Sản phẩm hot trong tuần</h2>
                        </div>
                        <!--Section Title End-->
                    </div>
                </div>
                <div class="row">
                    @foreach ($slider as $k=>$_item)
                        @if ($_item["banner_position_id"] == 3)
                            <div class="col-md-6">
                                <!--Single Categorie Collection Start-->
                                <div class="single-categorie-collection mt-30">
                                    <div class="categorie-collection-img">
                                        <a href="{{ $_item->link!="" ? $_item->link : "javascript:void(0);"  }}"><img src="{{ URL::to("/")."/".$path."banners/".$_item->source }}" alt="{{ $_item->source }}"></a>
                                    </div>
                                </div>
                                <!--Single Categorie Collection End-->
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!--Our Collection Area End-->
    @endif
    <!--Product Area Start-->
    <div class="product-area pt-20 pb-35">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--Section Title 2 Start-->
                    <div class="section-title2">
                        <h2>Sản phẩm</h2>
                    </div>
                    <!--Section Title 2 End-->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="bedroom">
                            <div class="row">
                                <div class="product-slider owl-carousel">
                                    <?php $productModal = []; ?>
                                    @foreach ($product as $items)

                                        <div class="col-md-12">
                                            @foreach($items as $_item)
                                                <?php $productModal[] = $_item; ?>
                                                <!--Single Product Area Start-->
                                                {!! templateProductItem($_item) !!}
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Product Area End-->

    <!--Blog Area Start-->
    <div class="blog-area pt-10 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--Section Title 2 Start-->
                    <div class="section-title2">
                        <h2>Blogs</h2>
                    </div>
                    <!--Section Title 2 End-->
                </div>
            </div>
            <div class="row">
                <div class="blog-slider owl-carousel">
                    @foreach ($blog as $_item)
                        <div class="col-md-12">
                            <!--Single Blog Start-->
                            <div class="single-blog">
                                <div class="blog-img img-full">
                                    <a href="{{ route('blog-detail',['slug'=>$_item['slug'], 'id'=>$_item['id']]) }}"><img src="{{ URL::to("/")."/".$path.'blogs/'.$_item['image'] }}" alt=""><span class="icon-view"></span></a>
                                </div>
                                <div class="blog-content">
                                    <h3 class="blog-title"><a href="{{ route('blog-detail',['slug'=>$_item['slug'], 'id'=>$_item['id']]) }}">Best of Hair & Makeup New York Spring/Summer 2016</a></h3>
                                    <div class="blog-meta">
                                        <p class="author-name">Đăng bởi: <span>{{ $_item['author'] }}</span> - {{ $_item["updated_at"] }}</p>
                                    </div>
                                    <a class="read-btn" href="{{ route('blog-detail',['slug'=>$_item['slug'], 'id'=>$_item['id']]) }}">Xem thêm</a>
                                </div>
                            </div>
                            <!--Single Blog End-->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--Blog Area End-->

    @foreach ($slider as $k=>$_item)
        @if ($_item["banner_position_id"] == 5)
            <div id="home-about-area" class="about-area about-bg" style="background-image: url('{{ URL::to("/")."/cactus/bg/bg-newletter.jpg" }}')">
                {{ Form::open(['route'=>'new_letter','method'=>'post','data-toggle'=>'validator']) }}
                    <div class="indecor-about">
                        <div class="section-title">
                            <span class="sub-title">Đăng ký nhận tin mới</span>
                        </div>
                        @include("cactus._include.success")
                        @include("cactus._include.error")
                        <div class="form-group">
                            <input required="required" type="email" value="" placeholder="Nhập email của bạn" name="email" aria-label="Email Address" class="input-content-newsletter" data-error="Email không được để trống">
                            <div class="help-block with-errors"></div>
                        </div>
                        <a onclick="$(this).next().click();" class="about-btn" href="javascript:void(0);">Đăng ký</a>
                        <input type="submit" style="display: none;">
                    </div>
                {{ Form::close() }}
                </form>
            </div>
        @endif
    @endforeach

    <!-- Modal Area Strat -->
    @foreach ($productModal as $_item)
        {!! templateModalProduct($_item) !!}
        <!-- Modal Area End -->
    @endforeach
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
