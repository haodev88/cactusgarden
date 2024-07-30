@extends('cms.master')
@section('title','Thêm sản phẩm')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm sản phẩm</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{!! route('admin_shop.product.index') !!}">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
                                    Danh sách sản phẩm
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open(['route'=>'admin_shop.product.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                            @include('cms.blocks.error')
                            <!-- category -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Danh mục">Danh mục <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select data-error='Vui lòng chọn danh mục' required="required" name="sltCategory" class="select2_single form-control col-md-7 col-xs-12">
                                        <option value="">Chọn</option>
                                        {!! menuMulti($listCate,$parent_id=0,$str="---|",old('sltCate')) !!}
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Supplier -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nhà cung cấp">Nhà cung cấp <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select required="required" data-error='Vui lòng chọn nhà cung cấp' data-href="{!! Route('get_brand') !!}" id="sltSupplier" name="sltSupplier" class="select2_single form-control col-md-7 col-xs-12">
                                        <option value="">Chọn</option>
                                        @if(!empty($listSupplier))
                                            @foreach($listSupplier as $item)
                                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Brand -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Thương hiệu">Thương hiệu <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select required="required" data-error='Vui lòng chọn thương hiệu' name="sltBrand" id="sltBrand" class="form-control col-md-7 col-xs-12">
                                        <option value="">Chọn</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- SKU -->
                            <div class="item form-group" id="check-sku">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SKU">SKU <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtSku',old('txtSku'), ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','data-href'=>Route('check_sku'),'id'=>'txtSku','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors" id="errorSku"></div>
                                </div>
                            </div>
                            <!-- Product name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Tên sản phẩm">Tên <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtName',old('txtName'), ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtName','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Product price -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Giá bán">Giá <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtPrice',old('txtPrice'), ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtPrice','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Product self-price -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Giá khuyến mãi">Giá khuyến mãi </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtPriceSelf', old('txtPriceSelf'), ['id'=>'txtPriceSelf','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Product count -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Số lượng">Số lượng <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtCount',old('txtCount'), ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtCount','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Short Desc -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả ngắn">Mô tả ngắn </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtShort',old('txtShort'),['id'=>'txtShort','class'=>'form-control col-md-7 col-xs-12'] ) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Long Desc -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả chi tiết">Mô tả chi tiết </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtLong',old('txtLong'),['id'=>'txtLong','class'=>'form-control col-md-7 col-xs-12'] ) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Attribute product -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Thuộc tính sản phẩm </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_single form-control col-md-7 col-xs-12" name="sltAttribute" id="sltAttribute">
                                        <option value="0">--Chọn--</option>
                                        @if(!empty($listAttribute))
                                            @foreach($listAttribute as $item)
                                                <optgroup label="{!! $item['name'] !!}">
                                                    @if(!empty($item['option']))
                                                        @foreach($item['option'] as $attr)
                                                            <option data-option-name="{!! $attr['name'] !!}" value="{!! $attr['option_id'] !!}">---| {!! $attr['name'] !!}</option>
                                                        @endforeach    
                                                    @endif
                                                </optgroup>
                                            @endforeach
                                        @endif        
                                    </select>
                                </div>
                            </div>
                            <!-- show attribute-->
                            <div class="item form-group" id="show-attribute-product" style="display:none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Thuộc tính sản phẩm">Thuộc tính sản phẩm đã chọn </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item-tag-warp">
                                        <!-- Attribute choose here -->
                                    </div>    
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Product images -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Hình sản phẩm">Tải Hình ảnh </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button onclick="$(this).next().click();" type="button" class="btn btn-success">Tải ảnh</button>
                                    <input style="display:none;" onchange="return mutipleImage(this);" class="col-md-7 col-xs-12" type="file" name="txtFile[]" multiple="multiple" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="item form-group" id="show-image-product" style="display:none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hình ảnh sản phẩm">Ảnh sản phẩm đã chọn </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="item-img-warp">
                                        <!-- image here -->
                                    </div>    
                                </div>
                            </div>
                            <!-- Hidden field for default images -->
                            {!! Form::hidden('defaultImageMain',0) !!} 
                            <div class="ln_solid"></div>
                            <!-- active-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Kích hoạt </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        {!! Form::checkbox('checkActive','1',false,['id'=>'checkActive','class'=>'flat']) !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /active -->
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
    <!-- type script -->
    @include('cms.product.javascript')
    <script type="text/javascript">
        /**
        |----------------------------
        | Call CKEDITOR
        |----------------------------
        */
        callCkeditor('txtShort');
        callCkeditor('txtLong');
    </script>
@endsection