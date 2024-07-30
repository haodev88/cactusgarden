@extends('cms.master')
@section('title','Cật nhật sản phẩm')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cập nhật sản phẩm</h2>
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
                       {!! Form::open(['route'=>['admin_shop.product.update','id'=>$product['id']],'name'=>'formInput','id'=>'formInput','method'=>'PUT','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                           
                            @include('cms.blocks.error')
                            <!-- category -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Danh mục">Danh mục <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select data-error="Vui lòng chọn danh mục" required="required" name="sltCategory" class="select2_single form-control col-md-7 col-xs-12">
                                        <option value="">Chọn</option>
                                        {!! menuMulti($listCate,$parent_id=0,$str="---|",$product['dt_category_id']) !!}
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Supplier -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nhà cung cấp">Nhà cung cấp <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select required="required" data-error="Vui lòng chọn nhà cung cấp" data-href="{!! Route('get_brand') !!}" id="sltSupplier" name="sltSupplier" class="select2_single form-control col-md-7 col-xs-12">
                                        <option value="">Chọn</option>
                                        @if(!empty($listSupplier))
                                            @foreach($listSupplier as $item)
                                                @if($item["id"] == $product["dt_supplier_id"])
                                                    <option selected="selected" value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                                @else
                                                    <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>    
                                                @endif    
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
                                    <select required="required" data-error="Vui lòng chọn thương hiệu" name="sltBrand" id="sltBrand" class="select2_single form-control col-md-7 col-xs-12">
                                        <option value="">Chọn</option>
                                        @if(!empty($listBrand))
                                            @foreach ($listBrand as $item)
                                                @if($item['id'] == $product['dt_brand_id'])
                                                    <option selected="selected" value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                                @else
                                                    <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                                @endif    
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- SKU -->
                            <div class="item form-group" id="check-sku">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SKU">SKU <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtSku',$product['sku'], ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','data-href'=>Route('check_sku'),'data-productId'=>$product['id'],'id'=>'txtSku','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors" id="errorSku"></div>
                                </div>
                            </div>
                            <!-- Product name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Tên sản phẩm">Tên <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtName',$product['name'], ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtName','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Product price -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Giá bán">Giá <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtPrice',$product['price'], ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtPrice','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Product self-price -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Giá khuyến mãi">Giá khuyến mãi </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtPriceSelf', $product['self_price'], ['id'=>'txtPriceSelf','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Product count -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Số lượng">Số lượng <span class="">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtCount',$product['count'], ['required'=>'required','data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtCount','class'=>'form-control col-md-7 col-xs-12']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Short Desc -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả ngắn">Mô tả ngắn </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtShort',$product['short_desc'],['id'=>'txtShort','class'=>'form-control col-md-7 col-xs-12'] ) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Long Desc -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả chi tiết">Mô tả chi tiết </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtLong',$product['long_desc'],['id'=>'txtLong','class'=>'form-control col-md-7 col-xs-12'] ) !!}
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
                            <div class="item form-group" id="show-attribute-product" style="<?= !empty($product['option']) ? 'display:block;' : 'display:none;'; ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Thuộc tính sản phẩm">Thuộc tính sản phẩm đã chọn </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item-tag-warp">
                                        <!-- Attribute choose here -->
                                        @if(!empty($product['option']))
                                            @foreach($product['option'] as $item)
                                                <div>
                                                    <span class="label label-tag"> {!! $item['name'] !!}
                                                        <input type="hidden" class="option_id" name="option_id[]" value="{!! $item['id'] !!}">
                                                        &nbsp;<span data-id="{!!  $item['id'] !!}" class="glyphicon glyphicon-remove remove-tag" aria-hidden="true"></span>
                                                    </span>    
                                                </div>
                                            @endforeach
                                        @endif        
                                    </div>    
                                </div>
                            </div>
                            <!-- Hidden field for remove attribute -->
                            <span id="append-delete-option"></span>
                                <!-- append input delete option -->
                            </span>
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
                            <div class="item form-group" id="show-image-product" style="@if($product['filename'] == '')  {!! 'display:none' !!} @endif">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hình ảnh sản phẩm">Ảnh sản phẩm đã chọn </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!-- image edit here -->
                                    <div id="img-edit">
                                        <?php  $defaultImage = ""; ?>
                                        @if(!empty($product['filename']) || $product['filename']!="")
                                            <?php 
                                                $images       = convertJsonToArray($product['filename']);
                                            ?>
                                            @foreach($images as $k=>$img)
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="find-img-default">
                                                        <div class="wrapper-image">
                                                            <img src="{!! Config('global.media_url').$img['image'] !!}" class="img-responsive" alt="Responsive image">
                                                            <span data-source='{!! $img['image'] !!}' class="glyphicon glyphicon-remove"></span>
                                                            {!! Form::hidden('txtOldImage[][image]',$img['image']) !!}
                                                        </div>
                                                        <div class="checkbox">
                                                            <?php $selected = false; ?>
                                                            @if($img['default'] == 1)
                                                                <?php 
                                                                    $defaultImage = $k; 
                                                                    $selected = true;
                                                                ?>
                                                            @endif
                                                            {!! Form::radio('checkImgDefault',1,$selected,['class'=>'flat','data-stt'=>$k]); !!}
                                                            <label style="padding-left:5px;">Chọn ảnh đại diện</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>    
                                    <!-- /image edit here -->
                                    <div id="item-img-warp">
                                        <!-- apend new images -->                  
                                    </div>
                                    <!-- image delete -->
                                    <div id="item-image-delete">
                                        <!-- append input hidden delete image -->        
                                    </div>
                                    <!-- Hidden field for default images -->
                                    {!! Form::hidden('defaultImageMain',$defaultImage) !!}    
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- active-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Kích hoạt </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        {!! Form::checkbox('checkActive',1, ($product['active'] == 1) ? true : false  ,['id'=>'checkActive','class'=>'flat']) !!}                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /active -->
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    {!! Form::submit('Cập nhật',['class'=>'btn btn-success']) !!}
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
<!-- include javascript -->
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