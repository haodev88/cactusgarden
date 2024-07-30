@extends('cms.master')
@section('title','Cập nhật thương hiệu')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cập nhật thương hiệu</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{!! route('admin_shop.brand.index') !!}">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
                                    Danh sách các thương hiệu
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open(['route'=>['admin_shop.brand.update','id'=>$brand['id']],'name'=>'formInput','id'=>'formInput','method'=>'PUT','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                            @include('cms.blocks.error')
                            <!-- brand-name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Tên thương hiệu <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtBrand',$brand['name'], ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtBrand','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- Short description -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Mô tả ngắn </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtShort',$brand['short_desc'], ['id'=>'txtShort','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>
                            <!-- Long description -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Mô tả ngắn </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('txtLong',$brand['long_desc'], ['id'=>'txtLong','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- upload img of brand -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tải ảnh đại diện">Tải ảnh đại diện </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button onclick="$(this).next().click();" type="button" class="btn btn-success">Tải ảnh</button>
                                    <input style="display:none;" onchange="return readURL(this,'show-img-brand',200,'div#show-image-brand-choose');" class="col-md-7 col-xs-12" type="file" name="txtFile">
                                </div>
                            </div>
                            <!-- show img of brand -->
                            <div id="show-image-brand-choose" class="item form-group" style="<?= !empty($brand['filename']) ? 'display:block':'display:none'; ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Ảnh đại diện</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(!empty($brand['filename']))
                                        <div class="wrapper-image">
                                            <img class="img-responsive" alt="{!! $brand['filename'] !!}" id="show-img-brand" src="{!! Config('global.root_media').'brands/'.$brand['filename'] !!}">
                                            &nbsp;<span id="remove-image-brand" data-image="{!! $brand['filename'] !!}" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </div>
                                    @else
                                        <img id="show-img-brand" src="/cms/images/blank.gif">
                                    @endif
                                </div>
                            </div>
                            <!-- hidden field for delete image brand-->
                            <input type="hidden" name="txtDeleteImage" value="">
                            <!-- /end --> 
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
    @include('cms.brand.javascript')
@endsection