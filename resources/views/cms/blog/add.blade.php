@extends('cms.master')
@section('title','Thêm blog')
@section('main_content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thêm blog</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{!! route('admin_shop.blog.index') !!}">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                                        Danh sách blog
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        {!! Form::open(['route'=>'admin_shop.blog.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator','enctype' => 'multipart/form-data']) !!}
                        @include('cms.blocks.error')
                        <!-- brand-name -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Tiêu đề <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('title', old('title'), ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'title','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Tác giả <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('author', old('author'), ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'title','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- short Blog-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Mô tả ngắn </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('short_desc', old('short_desc'), ['id'=>'short_desc','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>

                            <!-- Content Blog-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Nội dung </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    {!! Form::textarea('content', old('content'), ['id'=>'content','class'=>'form-control col-md-7 col-xs-12']) !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <!-- upload img of brand -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tải ảnh đại diện">Tải ảnh đại diện </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button onclick="$(this).next().click();" type="button" class="btn btn-success">Tải ảnh</button>
                                    <input style="display:none;" onchange="return readURL(this,'show-img-blog',200,'div#show-image-brand-choose');" class="col-md-7 col-xs-12" type="file" name="image">
                                </div>
                            </div>
                            <!-- show img of brand -->
                            <div id="show-image-brand-choose" class="item form-group" style="display:none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ảnh đại diện">Ảnh đại diện</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img id="show-img-blog" src="/cms/images/blank.gif">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tên thương hiệu">Tác giả <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="active" class="form-control col-md-7 col-xs-12">
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

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
    @include('cms.blog.javascript')
@endsection
