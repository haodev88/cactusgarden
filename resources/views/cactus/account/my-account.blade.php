@extends('cactus._include.master')
@section('title_page', 'Thông tin tài khoản')
@section('content')
    @include("cactus.account.breadcrumb")
    <div class="my-account white-bg">
        <div class="container">
            <div class="account-dashboard">
                <div class="row">
                    @include('cactus.account.menu')
                    <div class="col-md-12 col-lg-10">
                        <!-- Tab panes -->
                        <div class="dashboard-content">
                            <div id="account-details">
                                <h3>Thông tin tài khoản </h3>
                                <div class="login">
                                    <div class="login-form-container">
                                        <div class="account-login-form">
                                            {{ Form::open(['route'=>'post_my_account','method'=>'post','data-toggle'=>'validator']) }}
                                                <div class="input-radio">
                                                    <span class="custom-radio"><input {{ $info->gender == 1 ? "checked" : "" }} name="gender" value="1" type="radio"> Nam.</span>
                                                    <span class="custom-radio"><input {{ $info->gender == 0 ? "checked" : "" }} name="gender" value="0" type="radio"> Nữ</span>
                                                </div>
                                                <label>Họ tên</label>
                                                <input name="name" type="text" value="{{ $info->name }}">

                                                <label>Email</label>
                                                <input disabled="disabled" type="text" value="{{ $info->email }}">

                                                <label>Điện thoại</label>
                                                {{ Form::text('phone',$info->phone,['class'=>'form-control','required'=>'required', 'data-error'=>'Vui lòng nhập số điện thoại','placeholder'=>'','data-toggle'=>'validator']) }}

                                                <label>Password</label>
                                                <input name="password" type="password">

                                                <div class="button-box">
                                                    <button type="submit" class="default-btn">Cập nhật</button>
                                                </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
