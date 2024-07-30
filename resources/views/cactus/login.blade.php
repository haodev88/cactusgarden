@extends('cactus._include.master')
@section('title_page', 'Đăng nhập thành viên')
@section('content')
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <div class="login-register-area pb-50">
        <div class="container justify-content-center">
            <div class="row">
                <!--Login Form Start-->
                <div class="col-md-12 col-12">
                    <div class="customer-login-register register-pt-0">
                        <div class="form-login-title">
                            <h2>Đăng nhập</h2>
                        </div>
                        <div class="register-form config-2">
                            @include('cactus._include.error')
                            @include('cactus._include.success')
                            {{ Form::open(['route'=>'post-login','method'=>'post','data-toggle'=>'validator']) }}
                            <div class="form-fild form-group">
                                <p><label>Email <span class="required">*</span></label></p>
                                <input required='required' name="email" value="" type="email" data-error="Vui lòng nhập email">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-fild form-group">
                                <p><label>Mật khẩu <span class="required">*</span></label></p>
                                <input required='required' name="password" value="" type="password" data-error="Vui lòng nhập mật khẩu">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="login-submit">
                                <button type="submit" class="form-button">Đăng nhập</button>
                            </div>
                            <div class="lost-password">
                                <a href="{{ route("get-password") }}">Quên mật khẩu</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!--Login Form End-->
            </div>
        </div>
    </div>
@endsection
