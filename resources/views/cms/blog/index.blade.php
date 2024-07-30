@extends('cms.master')
@section('title','Danh sách blog')
@section('main_content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách blog</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.blog.create') !!}">
                                    Thêm Blog
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">STT </th>
                                        <th class="column-title">Tiêu đề</th>
                                        <th class="column-title">Tác giả</th>
                                        <th class="column-title">Ngày tạo </th>
                                        <th class="column-title"><span class="nobr">Hành động</span></th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <form action="" method="get">
                                            <td colspan="2"><input value="{{ isset($params["title"]) ? $params["title"] : '' }}" placeholder="Nhập tiêu đề cần tìm" name="title" type="text" class="form-control" /></td>
                                            <td colspan="2"><input value="{{ isset($params["author"]) ? $params["author"] : '' }}" placeholder="Nhập tên tác giả cần tìm" name="author" type="text" class="form-control" /></td>
                                            <td colspan="1"><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                            <input type="hidden" name="filter" value="1" />
                                        </form>
                                    </tr>
                                    <tbody style="border-top:none;">
                                    @if($blogs->count() !=0 )
                                        @foreach ($blogs as $item)
                                            <?php $stt++; ?>
                                            <tr class="even pointer">
                                                <td class="">{!! $stt !!}</td>
                                                <td>{!! $item['title'] !!}</td>
                                                <td>{!! $item['author'] !!}</td>
                                                <td class="">{!! date("d-m-y H:i",strtotime($item->created_at)) !!}</td>
                                                <td class="">
                                                    &nbsp;&nbsp;
                                                    {!! loadAction($item->id,'blog') !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="even pointer">
                                            <td colspan="5" align="center">Dữ liệu không tồn tại</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $blogs->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $blogs])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
