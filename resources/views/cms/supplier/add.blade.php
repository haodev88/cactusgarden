@extends('cms.master')
@section('title','Thêm nhà cung cấp')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm nhà cung cấp</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{!! route('admin_shop.supplier.index') !!}">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
                                    Danh sách các nhà cung cấp
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open(['route'=>'admin_shop.supplier.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                            @include('cms.blocks.error')
                            <!-- brand-name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên nhà cung cấp">Tên nhà cung cấp <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtSupplier',old('txtSupplier'), ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtSupplier','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- address -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên nhà cung cấp">Địa chỉ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtAddress',old('txtAddress'), ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtAddress','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- supplier-name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên nhà cung cấp">Nhân viên thu mua <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select required="required" data-error='Vui lòng chọn nhân viên thu mua' class="select2_single form-control col-md-7 col-xs-12" name="sltBuyer" id="sltBuyer">
                                        <option value="">Chọn</option>
                                        @if (!empty($listBuyer) && count($listBuyer)!=0)
                                            @foreach($listBuyer as $buyer)
                                                <option value="{!! $buyer['id'] !!}">{!! $buyer['name'] !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Short description -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả ngắn">Mô tả ngắn </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtShort',old('txtShort'), ['id'=>'txtShort','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>
                            <!-- Long description -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả chi tiết">Mô tả chi tiết </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtLong',old('txtLong'), ['id'=>'txtLong','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- upload img of supplier -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tải ảnh đại diện">Tải ảnh đại diện </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button onclick="$(this).next().click();" type="button" class="btn btn-success">Tải ảnh</button>
                                    <input style="display:none;" onchange="return readURL(this,'show-img-supplier',200,'div#show-image-supplier-choose');" class="col-md-7 col-xs-12" type="file" name="txtFile" id="txtFile">
                                </div>
                            </div>
                            <!-- show img of supplier -->
                            <div id="show-image-supplier-choose" class="item form-group" style="display:none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Ảnh đại diện</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img id="show-img-supplier" src="/cms/images/blank.gif">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Brand of supplier -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Thương hiệu">Thương hiệu <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_single form-control col-md-7 col-xs-12" name="sltBrand" id="sltBrand">
                                        <option value="">Chọn</option>
                                        @foreach($listBrand as $brand)
                                            <option value="{!! $brand['id'] !!}">{!! $brand['name'] !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- show brand add-->
                            <div id="show-brand-add" class="item form-group" style="display:none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Thương hiệu đã chọn</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item-tag-warp" id="append_brand">
                                        {{-- <span class="label label-tag">samsung
                                            <input type="hidden" class="brand_id" name="brand_id[]" value="">
                                            &nbsp;<span data-id="'+id+'" class="glyphicon glyphicon-remove remove-tag" aria-hidden="true"></span></span> --}}
                                    </div>    
                                </div>
                            </div>
                            <!-- /brand of supplier-->
                            <div class="ln_solid"></div>
                            <!-- submit form -->
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
    @include('cms.supplier.javascript')
@endsection