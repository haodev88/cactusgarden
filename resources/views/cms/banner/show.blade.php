@extends('cms.master')
@section('title','Chi tiết bannner')
@section('main_content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tải Banner</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{!! route('admin_shop.banner.index') !!}">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                                        Vị trí các banner
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p>Nhấn vào khung quét hình ảnh để tải.</p>
                            <form id="uploadBanner" action="{{ route('uploadBanner') }}" class="dropzone">
                                @if (isset($list['banner']) && !empty($list['banner']))
                                    <div class="col-md-12">
                                        @foreach($list['banner'] as $item)
                                            <div class="col-md-55 banner-position" data-id="{{ $item["id"] }}">
                                                <div class="thumbnail">
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; height: 100%; display: block;" src="/{{ $path.'/'.$item['source'] }}" alt="image" />
                                                        <div class="mask">
                                                            <div class="tools tools-bottom">
                                                                <a class="edit-banner btn btn-info btn-xs" data-toggle="modal" data-target=".modal-edit" href="#"><i class="fa fa-pencil"></i></a>
                                                                <a class="btn btn-danger btn-xs" href="{{ route('clearBanner',['id'=>$item['id']]).'?position_id='.$id }}"><i class="fa fa-trash-o"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="link-banner text-hide">{{ $item["link"]}}</div>
                                                <div class="desc-banner text-hide">{{ $item["desc"]}}</div>
                                                <div class="old-banner text-hide">{{ $item["source"] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="position_id" value="{{ $id }}">
                            </form>
                        </div>
                        <div class="text-center">
                            <button style="margin-top: 5px;" id="imgsubbutt" type="button" class="btn btn-success">Tải lên máy chủ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- modal-->
    <div class="modal fade modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <form method="post" action="{{ route("updateBanner") }}" id="form-edit-banner" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Chỉnh sửa</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img_banner">Banner</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="img_banner" type="file" class="form-control col-md-7 col-xs-12" name="img_banner">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link_edit">Link</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="link_edit" name="link_edit" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="id_banner" name="id_banner">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="position_id" value="{{ $id }}">
                                                <input type="hidden" name="old_banner" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc_edit">Mô tả</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control" cols="100" rows="10" name="desc_edit" id="desc_edit"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Thay Đổi</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- /modal -->
@endsection
@section('call_library_js')
    <script src="/cms/vendors/dropzone/dist/min/dropzone.min.js"></script>
@endsection

@section('javascript')
    @include('cms.banner.javascript')
@endsection
