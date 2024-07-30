@extends('cms.master')
@section('title','Thêm thành viên')
@section('main_content')
    <!-- page content -->
    <div class="right_col" group="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thêm thành viên</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{{ route('admin_shop.customer.index')  }}">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                                        Danh sách các thành viên
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            {{ Form::open(['route'=>'admin_shop.customer.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator']) }}
                                @include('cms.blocks.error')
                                <!-- for name group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên thành viên <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtName',old('txtName'),['data-error'=>'Vui lòng nhập dữ liệu', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- / for name -->
                                <!-- for address  -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Địa chỉ thành viên </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtAddress',old('txtAddress'),['class'=>'form-control col-md-7 col-xs-12']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- / for address  -->

                                <!-- for city -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Tĩnh/Thành phố </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="sltCity" id="sltCity" class="form-control select2_single">
                                            <option value="0">Chọn</option>
                                            @if(!empty($province))
                                                @foreach($province as $item)
                                                    <option value="{{ $item->provinceid }}">{{ $item->type.' '.$item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- /city -->
                                <!-- for district -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Quận/Huyện </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="sltDistrict" id="sltDistrict" class="form-control select2_single">
                                            <option value="0">Chọn</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- /district -->

                                <!-- for ward -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ward">Phường/Xã </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="sltWard" id="sltWard" class="form-control select2_single">
                                            <option value="0">Chọn</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- /ward -->

                                <!-- for email group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Email <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::email('txtEmail',old('txtEmail'),['data-error'=>'Email không hợp lệ', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for email -->
                                <!-- for password group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Mật khẩu <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::password('txtPassword',['data-error'=>'Vui lòng nhập mật khẩu', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for password -->
                                <!-- for email group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Điện thoại <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtPhone',old('txtPhone'),['data-error'=>'Vui lòng nhập dữ liệu', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for email -->
                                <!-- for birthday -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Ngày sinh </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtBirthday',old('txtBirthday'),['data-inputmask'=>'"mask":"99/99/9999"','class'=>'form-control col-md-7 col-xs-12']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for birthday -->
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        {{ Form::submit('Th&ecirc;m',['class'=>'btn btn-success']) }}
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('javascript')
    @include('cms.customer.javascript')
@endsection