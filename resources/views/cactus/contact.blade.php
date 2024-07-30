@extends('cactus._include.master')
@section('title_page', 'Liên hệ')
@section('content')
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <style>
        @media screen and (max-width: 575px){
            .g-recaptcha {
                transform:scale(0.66); !important;
                -webkit-transform:scale(0.66) !important;
                transform-origin:0 0 !important;
                -webkit-transform-origin:0 0 !important;
            }
        }

    </style>
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--/Breadcrumb-->
    <!--Contact Us Area Start-->
    <div class="contact-us-area pb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="store-information">
                        <div class="store-title">
                            <h4>Thông tin cửa hàng</h4>
                            <div class="communication-info">
                                <!--Single Communication Start-->
                                <div class="single-communication">
                                    <div class="communication-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="communication-text">
                                        <span>{{ Config("global.infomation_shop.address") }}</span>
                                    </div>
                                </div>
                                <!--Single Communication End-->
                                <!--Single Communication Start-->
                                <div class="single-communication">
                                    <div class="communication-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="communication-text">
                                        <span>Call us: <br><a href="tel:8001234567">{{ Config("global.infomation_shop.hotline") }}</a></span>
                                    </div>
                                </div>
                                <!--Single Communication End-->
                                <!--Single Communication Start-->
                                <div class="single-communication">
                                    <div class="communication-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="communication-text">
                                        <span>Email us: <br><a href="mailto:demo@hastech.com">{{ Config("global.infomation_shop.email") }}</a></span>
                                    </div>
                                </div>
                                <!--Single Communication End-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="content-wrapper">
                        <div class="page-content">
                            <div class="contact-form">
                                <div class="contact-form-title">
                                    <h3>Liên hệ với chúng tôi</h3>
                                </div>
                                @include('cactus._include.error')
                                @include('cactus._include.success')
                                {{ Form::open(['id'=>'form-contact','route'=>'post-contact','method'=>'post','data-toggle'=>'validator']) }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="contact-form-style mb-20 form-group">
                                                <input value="{{ old("name") }}" name="name" placeholder="Họ và tên" type="text" required data-error="Vui lòng nhập họ tên">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-form-style mb-20 form-group">
                                                <input value="{{ old("email") }}" name="email" placeholder="Email" type="email" required data-error="Email không hợp lệ">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style mb-20 form-group">
                                                <input value="{{ old("subject") }}" name="subject" placeholder="Tiêu đề" type="text" required data-error="Vui lòng nhập tiêu đề">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style mb-20 form-group">
                                                <input value="{{ old("phone") }}" name="phone" placeholder="Số điện thoại" type="text" required data-error="Vui lòng nhập điện thoại">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style">
                                                <div class="form-group">
                                                    <textarea name="content" placeholder="Nội dung" required data-error="Vui lòng nhập nội dung">{{ old("content") }}</textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="g-recaptcha" data-sitekey="6Lcmrr8UAAAAAOQAgTRcvGUsrr2L641sMUzKFMxW"></div>
                                                <div class="has-error has-danger" id="error-capcha">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <button class="default-btn" type="submit"><span>Gởi</span></button>
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact Us Area End-->
@endsection

@section('js')
    <script type="text/javascript">
        $('form#form-contact').validator().on('submit', function (e) {
            $("div#error-capcha div.with-errors").html("");
            if (!e.isDefaultPrevented()) {
                var response = grecaptcha.getResponse();
                if(response.length == 0) {
                    $("div#error-capcha div.with-errors").html("Lỗi Capcha");
                    return false;
                }
            }
        })
    </script>
@endsection

