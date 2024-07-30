@extends('cms.master')
@section('title','Danh sách các chức năng')
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
                            <h2>Danh sách các chức năng</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.permission.create') !!}">
                                    Thêm chức năng
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
                                            <th class="column-title" style="width:20%;">STT</th>
                                            <th class="column-title">Controller</th>
                                            <th class="column-title">Chức năng</th>
                                            <th class="column-title">Ngày tạo </th>
                                            <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{!! Route('searchPermission') !!}" method="get">                                       
                                            <td colspan="4"><input value="<?= isset($input['permission']) ? $input['permission']:''?>" placeholder="Nhập chức năng cần tìm" name="permission" type="text" class="form-control" /></td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @foreach ($listPermission as $item)
                                        <?php $stt++; ?>
                                        <tr class="even pointer">
                                            <td>{!! $stt !!}</td>
                                            <td>{!! $item->name !!}</td>
                                            <td>{!! $item->description !!}</td>
                                            <td>{!! date("d-m-Y H:i:s",strtotime($item->created_at)) !!}</td>
                                            <td>
                                                &nbsp;&nbsp;
                                                {!! loadAction($item->id,'permission') !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listPermission->appends($append)]);
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listPermission])
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection