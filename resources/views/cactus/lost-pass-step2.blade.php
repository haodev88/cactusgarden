@extends('cactus._include.master')
@section('title_page', 'Quên mật khẩu')
@section('content')
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->

    <div class="login-register-area pb-50">
        <div class="container justify-content-center">
            <div class="row">
                <!--Login Form Start-->
                <div class="col-md-12 col-12">
                    <div class="customer-login-register register-pt-0">
                        <div class="form-login-title">
                            <h2>Quên mật khẩu</h2>
                        </div>
                        <div class="register-form config-2">
                            @include('cactus._include.error')
                            {{ Form::open(['route'=>'post-reset-password','method'=>'post','data-toggle'=>'validator']) }}

                            <div class="form-fild form-group">
                                <p><label>Mật khẩu <span class="required">*</span></label></p>
                                <input id="password" required='required' name="password" value="" type="password" data-error="Vui lòng nhập mật khẩu">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-fild form-group">
                                <p><label>Xác Nhận Mật khẩu <span class="required">*</span></label></p>
                                <input data-match="#password" required='required' name="password" value="" type="password" data-error="Mật khẩu và xác nhận mật khẩu không trùng khớp">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="login-submit">
                                <button type="submit" class="form-button">Thay đổi</button>
                            </div>
                            {{ Form::hidden('check_sum',$checkSum) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!--Login Form End-->
            </div>
        </div>
    </div>
@endsection
