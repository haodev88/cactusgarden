@extends('cms.master')
@section('title','Sửa danh mục')
@section('main_content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="x_title">
                        <h2>Cập nhật danh mục</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{!! route('admin_shop.category.index') !!}">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
                                    Danh sách danh mục
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                        {!! Form::open(['route'=>['admin_shop.category.update', $cate['id']],'name'=>'formInput','id'=>'formInput','method'=>'PUT','class'=>'form-horizontal form-label-left','role'=>'form','data-toggle'=>'validator']) !!}
                            @include('cms.blocks.error')
                            <div class="item">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ROOT <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control select2_single" required='required' data-error='Vui lòng chọn' name="sltCate" id="sltCate">
                                           <option data-slug="" value="0">ROOT</option>
                                           {!! menuMulti($listCate,$parent_id=0,$str="---|",$cate['parent_id']) !!}
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tên danh mục <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('txtCate',$cate['title'], ['data-error'=>'Vui lòng nhập dữ liệu','id'=>'txtCate','class'=>'form-control col-md-7 col-xs-12','required'=>'required']) !!} 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <!-- for hidden field-->
                                    {!! Form::hidden('txtSlugRoot','',['id'=>'txtSlugRoot']) !!}
                                    <!-- / hidden field -->
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
    <script type="text/javascript">
        $(function() {
            // default for category
            var slgDefault = $("select[name=sltCate]").find("option:selected").attr('data-slug');
            $("input[name=txtSlugRoot]").val(slgDefault);
            // function when change event
            $("select[name=sltCate]").on("change",function() {
                var slugRoot = $(this).find("option:selected").attr('data-slug');
                $("input[name=txtSlugRoot]").val(slugRoot);
            });
        });
    </script>
@endsection