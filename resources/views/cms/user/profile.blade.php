@extends('cms.master')
@section('title','Thông tin cá nhân')
@section('main_content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thông tin cá nhân</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{ asset($path.'/avatars/'.$user['avatar']) }}" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>{{ $user['username'] }}</h3>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- start recent activity -->
                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Tài khoản <span class="required">*</span></label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        {!! Form::text('txtUser',$user['username'], ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtUser','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <!-- end recent activity -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection