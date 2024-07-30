@extends('cactus._include.master')
@section('title_page', 'Đăng ký thành viên')
@section('content')
    <!--Breadcrumb Area Start-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <div class="login-register-area pb-50">
        <div class="container justify-content-center">
            <div class="row">
                <!--Register Form Start-->
            <div class="col-md-12 col-12">
                <div class="customer-login-register register-pt-0">
                    <div class="form-register-title">
                        <h2>Đăng ký</h2>
                    </div>
                    <div class="register-form config-2">
                        @include('cactus._include.error')
                        @include('cactus._include.success')
                        {{ Form::open(['route'=>'post-register','method'=>'post','data-toggle'=>'validator']) }}
                            <div class="form-fild form-group">
                                <p><label>Giới tính</label></p>
                                <select name="gender" class="form-control" required='required' data-error='Vui lòng chọn giới tính'>
                                    <option value="">Chọn</option>
                                    <option value="1" <?= old('gender') == 1 ? 'selected="selected"' : '' ?>>Nam</option>
                                    <option value="0" <?= (old('gender')!='' && old('gender') == 0) ? 'selected="selected"' : '' ?>>Nữ</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-fild form-group">
                                <p><label>Họ Tên <span class="required">*</span></label></p>
                                <input required='required' name="name" value="" type="text" data-error="Vui lòng nhập họ tên">
                                <div class="help-block with-errors"></div>
                            </div>
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
                            <div class="register-submit">
                                <button type="submit" class="form-button">Đăng ký</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <!--Register Form End-->
        </div>
    </div>
@endsection
