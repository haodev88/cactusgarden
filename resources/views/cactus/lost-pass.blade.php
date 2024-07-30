@extends('cactus._include.master')
@section('title_page', 'Quên mật khẩu')
@section('content')
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->

    <div class="blog-area pb-50">
        <div id="account-forgotten" class="container" style="min-height:250px">
            <div class="row">
                <div id="content" class="col-sm-12">
                    <p>Nhập địa chỉ Email đăng nhập. Nhấn gởi để thiết lập lại mật khẩu.</p>
                    @include('cactus._include.error')
                    @include('cactus._include.success')
                    {{ Form::open(['route'=>'post-password','method'=>'post','data-toggle'=>'validator']) }}
                        <div class="form-fild form-group">
                            <p><label>Email <span class="required">*</span></label></p>
                            <input required="required" name="email" value="" type="email" data-error="Vui lòng nhập email">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="form-button">Gởi</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
