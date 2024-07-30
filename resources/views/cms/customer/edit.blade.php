@extends('cms.master')
@section('title','Cập nhật thành viên')
@section('main_content')
    <!-- page content -->
    <div class="right_col" group="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Cập nhật thành viên</h2>
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
                            {{ Form::open(['route'=>['admin_shop.customer.update','id'=>$customer->id],'name'=>'formInput','id'=>'formInput','method'=>'PUT','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator']) }}
                                @include('cms.blocks.error')
                                <!-- for name group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên thành viên <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtName',$customer->name,['data-error'=>'Vui lòng nhập dữ liệu', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- / for name -->
                                <!-- for address  -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Địa chỉ thành viên </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtAddress',$customer->address,['class'=>'form-control col-md-7 col-xs-12']) }}
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
                                                    @if($item['dt_provinceid'] == $customer->dt_provinceid)
                                                        <option selected="selected" value="{{ $item->provinceid }}">{{ $item->type.' '.$item->name }}</option>
                                                    @else
                                                        <option value="{{ $item->provinceid }}">{{ $item->type.' '.$item->name }}</option>
                                                    @endif
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
                                        {{ Form::email('txtEmail',$customer->email,['data-error'=>'Email không hợp lệ', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for email -->
                                <!-- for password group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Mật khẩu</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::password('txtPassword',['class'=>'form-control col-md-7 col-xs-12']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for password -->
                                <!-- for email group -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Điện thoại <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtPhone',$customer->phone,['data-error'=>'Vui lòng nhập dữ liệu', 'class'=>'form-control col-md-7 col-xs-12','required'=>'required']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for email -->
                                <!-- for birthday -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Ngày sinh </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::text('txtBirthday',($customer->birthday != 0 ) ? date("d-m-Y",strtotime($customer->birthday))  : '',['data-inputmask'=>'"mask":"99/99/9999"','class'=>'form-control col-md-7 col-xs-12']) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <!-- for birthday -->
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        {{ Form::hidden('id',$customer->id) }}
                                        {{ Form::submit('Cập nhật',['class'=>'btn btn-success']) }}
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