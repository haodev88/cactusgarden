@extends('cms.master')
@section('title','Danh sách landing page')
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
                            <h2>Danh sách các trang</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{{ route('admin_shop.page.create') }}">
                                    Thêm trang
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
                                        <th class="column-title">#</th>
                                        <th class="column-title">Tên</th>
                                        <th class="column-title">Code</th>
                                        <th class="column-title">Trạng thái</th>
                                        <th class="column-title">Ngày tạo </th>
                                        <th class="column-title"><span class="nobr">Hành động</span></th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <form action="" method="get">
                                            <td colspan="4"><input placeholder="Nhập trang cần tìm" name="name" type="text" class="form-control" /></td>
                                            <td colspan="1"><input placeholder="Nhập code cần tìm" name="code" type="text" class="form-control" /></td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                            <input type="hidden" name="filter" value="1">
                                        </form>
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @foreach ($list as $_item)
                                            <?php $stt++; ?>
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>{{ $_item->name }}</td>
                                                <td>{{ $_item->code }}</td>
                                                <td>{!! $_item->status == 1 ? '<span><i class="fa fa-check-circle"></i></span>' : '<span><i class="fa fa-close"></i></span>' !!}</td>
                                                <td>{{ $_item->created_at }}</td>
                                                <td>{!! loadAction($_item->id, 'page') !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
