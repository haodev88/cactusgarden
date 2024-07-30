@extends('cms.master')
@section('title','Thêm Trang')
@section('main_content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thêm Trang</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{!! route('admin_shop.page.index') !!}">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                                        Danh sách Trang
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            {!! Form::open(['route'=>'admin_shop.page.store','name'=>'formInput','id'=>'formInput','method'=>'POST','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator']) !!}
                            @include('cms.blocks.error')
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên Trang <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name','', ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'name','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Slug <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('slug','', ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'slug','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Code <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('code',old('code'), ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'code','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Nội dung <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::textarea('content',old('content'),['id'=>'content','class'=>'form-control col-md-7 col-xs-12','required'=>'required','data-error'=>'Vui lòng nhập dữ liệu']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::checkbox('status', 1, true , ['id'=>'status','class'=>'flat']) !!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                <!-- / hidden field -->
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
    <script type="text/javascript">
        $(function() {
            callCkeditor('content');
        });
    </script>
@endsection
