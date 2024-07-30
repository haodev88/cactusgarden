@extends('cms.master')
@section('title','Thêm nhóm thuộc tính')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm nhóm thuộc tính</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{!! route('admin_shop.option-group.index') !!}">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
                                    Danh sách nhóm thuộc tính
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open(['route'=>'admin_shop.option-group.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator']) !!}
                            @include('cms.blocks.error')
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên nhóm thuộc tính <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtName','', ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtName','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    {!! Form::submit('Thêm',['class'=>'btn btn-success']) !!}
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
@stop
@section('javascript')
    
@endsection