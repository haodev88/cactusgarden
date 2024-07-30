@extends('cms.master')
@section('title','Cập nhật nhà cung cấp')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cập nhật nhà cung cấp</h2>
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
                        {!! Form::open(['route'=>['admin_shop.supplier.update','id'=>$supplier->id],'name'=>'formInput','id'=>'formInput','method'=>'PUT','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                            @include('cms.blocks.error')
                            <!-- brand-name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên nhà cung cấp">Tên nhà cung cấp <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtSupplier',$supplier->name, ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtSupplier','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- address -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên nhà cung cấp">Địa chỉ <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtAddress',$supplier->address, ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtAddress','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
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
                                                @if($supplier->dt_buyer_id == $buyer['id'])
                                                    <option selected="selected" value="{!! $buyer['id'] !!}">{!! $buyer['name'] !!}</option>
                                                @else
                                                    <option value="{!! $buyer['id'] !!}">{!! $buyer['name'] !!}</option>  
                                                @endif        
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
                                    {!! Form::textarea('txtShort',$supplier->short_desc, ['id'=>'txtShort','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>
                            <!-- Long description -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mô tả chi tiết">Mô tả chi tiết </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtLong',$supplier->long_desc, ['id'=>'txtLong','class'=>'form-control col-md-7 col-xs-12']) !!}
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
                            <div id="show-image-supplier-choose" class="item form-group" style="<?= !empty($supplier->filename) ? 'display:block' : 'display:none' ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Ảnh đại diện</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $file = sizeOfFileName($supplier->filename,'60x60'); ?>
                                    <div class="wrapper-image">
                                        <img id="show-img-supplier" src="{!! Config('global.root_media').'suppliers/'.$file['path'].$file['filename'] !!}">
                                        <span id="remove-image-supplier" data-image='{!! $supplier->filename !!}' class="glyphicon glyphicon-remove"></span>
                                        {!! Form::hidden('txtOldImage',$supplier->filename) !!}
                                    </div>
                                </div>
                            </div>
                            <!-- hidden field for delete image supplier -->
                            {!! Form::hidden('txtDeleteImage','') !!}
                            <!-- /hidden field -->
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
                            <div id="show-brand-add" class="item form-group" style="<?= ($supplier->brand->count()!=0) ? 'display:block;' : 'display:none;'; ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Thương hiệu đã chọn</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item-tag-warp" id="append_brand">
                                        @foreach($supplier->brand as $item)
                                            <span class="label label-tag">{!! $item->name !!}
                                                <input type="hidden" class="brand_id" name="brand_id[]" value="{!! $item->id !!}">
                                                &nbsp;<span data-delete="{!! $item->id !!}" data-id="{!! $item->id !!}" class="glyphicon glyphicon-remove remove-tag" aria-hidden="true"></span></span>
                                        @endforeach
                                    </div>    
                                </div>
                            </div>
                            <!-- /brand brand add -->
                            <!-- hidden field for delete brand -->
                            <span id="append-delete-brand"></span>
                            <!-- /hidden field for delete brand -->
                            <div class="ln_solid"></div>
                            <!-- submit form -->
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
@section('javascript')
    @include('cms.supplier.javascript')
@endsection