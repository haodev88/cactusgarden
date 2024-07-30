@extends('cms.master')
@section('title','Danh sách nhóm')
@section('main_content')     
    <!-- page content -->
    <div class="right_col" group="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách các nhóm</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.group.create') !!}">
                                    Thêm nhóm quản trị
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
                                            <th class="column-title">Nhóm</th>
                                            <th class="column-title">Ngày tạo </th>
                                            <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{!! Route('searchUserGroup') !!}" method="get">                                       
                                            <td colspan="3"><input value="<?= isset($input['group']) ? $input['group']:''?>" placeholder="Nhập nhóm cần tìm" name="group" type="text" class="form-control" /></td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @foreach ($listGroup as $item)
                                        <?php $stt++; ?>
                                        <tr class="even pointer">
                                            <td>{!! $stt !!}</td>
                                            <td>{!! $item->name !!}</td>
                                            <td>{!! date("d-m-Y H:i:s",strtotime($item->created_at)) !!}</td>
                                            <td>
                                                &nbsp;&nbsp;
                                                {!! loadAction($item->id,'group') !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listGroup->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listGroup])
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection