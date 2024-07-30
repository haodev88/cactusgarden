@extends('cms.master')
@section('title','Thêm quản trị viên')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm quản trị viên</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{!! route('admin_shop.user.index') !!}">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
                                    Danh sách các quản trị viên
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- tab for user-->
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" role="tab" data-toggle="tab" aria-expanded="true">Tài khoản</a></li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" data-toggle="tab" aria-expanded="false">Phân quyền</a></li>
                    </ul>
                    <!-- end tab for user -->
                    <div class="x_content">
                        {!! Form::open(['route'=>'admin_shop.user.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                            <div class="tab-content">
                                <!-- tab 1-->
                                <div role="tabpanel" class="tab-pane fade in active" id="tab_content1" aria-labelledby="home-tab">
                                    @include('cms.blocks.error')
                                    <!-- for username  -->
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tài khoản <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('txtUser','test', ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtUser','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                     <!-- for name  -->
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Họ tên <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('txtName','test', ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtName','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <!-- Action -->
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('txtEmail','test@gmail.com', ['placeholder'=>'','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtPermission','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <!-- for role desc -->
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Mật khẩu <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::password('txtPass',['data-error'=>'Vui lòng nhập mật khẩu','id'=>'txtPass','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Hình sản phẩm">Ảnh đại diện </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <button onclick="$(this).next().click();" type="button" class="btn btn-success">Tải ảnh</button>
                                            <input style="display:none;" onchange="return readURL(this,'show-image-user',200,'div#show-image-user-choose');" class="col-md-7 col-xs-12" type="file" name="txtFile">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!-- show img of user -->
                                    <div id="show-image-user-choose" class="item form-group" style="display:none;">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Ảnh đại diện</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <img id="show-image-user" src="/cms/images/blank.gif">
                                        </div>
                                    </div>


                                </div> 
                                <!-- / tab 1--> 
                                <!-- tab 2 -->
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                    <div class="item">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Thuộc nhóm </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select name="sltGroup[]" data-width="90%" class="select2_multiple form-control" multiple="multiple">
                                                    @if(!empty($userGroup))
                                                        @foreach($userGroup as $group)
                                                            <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                                        @endforeach 
                                                    @endif
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <!-- Permission -->  
                                    <div class="item">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chức năng <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {!! Form::select('roles[]', $roles,[], array('required'=>'required','data-error'=>'Vui lòng chọn chức năng','class' => 'form-control','multiple')) !!}
                                                 <div class="help-block with-errors"></div>
                                            </div>

                                        </div>
                                    </div>            
                                    <!-- / Permission -->  
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            {!! Form::submit('Thêm',['class'=>'btn btn-success']) !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab 2 -->
                               
                            </div> 
                        {{ Form::close() }}       
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@stop
@section('javascript')
    
    <script type="text/javascript">
        // load icheck for check box
        loadIcheck();
        
        // create select multiple
        $(".select2_multiple").select2({
            // maximumSelectionLength: 4,
            // placeholder: "With Max Selection limit 4",
            allowClear: true
        });

    </script>

@endsection