<header>
    <!--Default Header Area Start-->
    <div class="default-header-area header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-12">
                    <!--Logo Area Start-->
                    <div class="logo-area">
                        <a href="{{ URL::to("/") }}"><img src="{{ URL::to("/") }}/cactus/img/logo/logo.png" alt=""></a>
                    </div>
                    <!--Logo Area End-->
                </div>
                <div class="col-lg-6 col-md-4 d-none d-lg-block col-12">
                    @if(!empty($topMenu))
                    <!--Header Menu Area Start-->
                    <div class="header-menu-area text-center">
                        <nav>
                            <ul class="main-menu">
                                @foreach ($topMenu as $_item)
                                    <li>
                                        <a href="{{ $_item['url'] }}">{{ $_item['label'] }}
                                        @if(isset($_item["dropdown"]) && $_item["dropdown"]!="")
                                            <i class="ion-ios7-arrow-down"></i></a>
                                            {!! $_item["dropdown"] !!}
                                        @else
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <!--Header Menu Area End-->
                    @endif
                </div>
                <div class="col-lg-3 col-md-5 col-12">
                    <!--Header Search And Mini Cart Area Start-->
                    <div class="header-search-cart-area">
                        <ul>
                            <li><a class="sidebar-trigger-search" href="javascript:void(0);"><span class="icon_search"></span></a></li>
                            <li class="currency-menu"><a href="javascript:void(0);"><span class="icon_lock_alt"></span></a>
                                <!--Crunccy dropdown-->
                                <ul class="currency-dropdown">
                                    <li><a href="javascript:void(0);">Tài khoản</a>
                                        <ul>
                                            @if(getUserInfo()!='')
                                                <li><a href="{{ route("account_dashboard") }}">Tài khoản của tôi</a></li>
                                                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                            @else
                                                <li><a href="{{ route("get-register") }}">Đăng ký</a></li>
                                                <li><a href="{{ route("get-login") }}">Đăng nhập</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                                <!--Crunccy dropdown-->
                            </li>

                            <li class="mini-cart">
                                <a href="javascript:void(0);"><span class="icon_bag_alt"></span> <span class="cart-quantity">{{ $totalItem }}</span>
                                    <span class="mini-cart-total">
                                        @if($totalPrice!=null) {!! currentPriceFormat($totalPrice) !!}
                                        @else &nbsp; @endif
                                    </span>
                                </a>
                                <!--Mini Cart Dropdown Start-->
                                <div class="header-cart">
                                    <?php $total = 0; ?>
                                    <ul class="cart-items">
                                        @if(!empty($listCartItems))
                                            @foreach ($listCartItems as $k=>$_item)
                                                <?php
                                                    $template = headerCart();
                                                    $template = str_replace("{LINK}",route("detail",["alias"=>$_item["slug"],"id"=>$_item["id"]]),$template);
                                                    $template = str_replace("{IMAGE}",URL::to("/").Config('global.media_url').$_item['default_image'],$template);
                                                    $template = str_replace("{NAME}",$_item["name"],$template);
                                                    $template = str_replace("{QUANTIY}",$_item["quanlity"],$template);
                                                    $template = str_replace("{PRICE}",currentPriceFormat($_item["price"]),$template);
                                                    $template = str_replace("{KEY}",$k,$template);
                                                    echo $template;
                                                ?>
                                            @endforeach
                                        @else
                                            <li class="single-cart-item" style="border:none;">
                                                <p class="text-center">Giỏ hàng rỗng</p>
                                            </li>
                                        @endif
                                    </ul>
                                    <?php $display = $totalPrice!=null ? 'block':'none'; ?>
                                    <div class="cart-total" style="display: {{$display}}">
                                        <h5>Tổng tiền :<span class="float-right">{!! currentPriceFormat($totalPrice) !!}</span></h5>
                                    </div>
                                    <div class="cart-btn" style="display: {{$display}}">
                                        <a href="{{ Route("view-cart") }}">Xem giỏ hàng</a>
                                        <a href="{{ route("order-infomation") }}">Thanh toán</a>
                                    </div>
                                </div>
                                <!--Mini Cart Dropdown End-->
                            </li>

                        </ul>
                    </div>
                    <!--Header Search And Mini Cart Area End-->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!--Mobile Menu Area Start-->
                    <div class="mobile-menu d-lg-none"></div>
                    <!--Mobile Menu Area End-->
                </div>
            </div>
        </div>
    </div>
    <!--Default Header Area End-->
</header>
<!--Header Area Start-->
<!-- main-search start -->
<div class="main-search-active">
    <div class="sidebar-search-icon">
        <button class="search-close"><span class="ion-android-close"></span></button>
    </div>
    <div class="sidebar-search-input">
        <form action="{{ route("search-product") }}" method="get">
            <div class="form-search">
                <input name="tu-khoa" id="search" class="input-text" value="" placeholder="Tìm kiếm sản phẩm" type="search">
                <button>
                    <i class="ion-android-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<!-- main-search End -->

