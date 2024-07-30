@extends('cms.master')
@section('title','Danh sách các thương hiệu')
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
                            <h2>Danh sách các thương hiệu</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.brand.create') !!}">
                                    Thêm thương hiệu
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
                                            <th class="column-title">Thương hiệu </th>
                                            <th class="column-title">Ảnh đại diện</th>
                                            <th class="column-title">Ngày tạo </th>
                                            <th class="column-title"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{!! Route('searchbrand') !!}" method="get">                                       
                                            <td colspan="4"><input placeholder="Nhập thương hiệu cần tìm" name="brandname" type="text" class="form-control" /></td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @if($listBrand->count() !=0 )
                                            @foreach ($listBrand as $item)
    	                                        <?php $stt++; ?>
    	                                        <tr class="even pointer">
    	                                            <td class="">{!! $stt !!}</td>
    	                                            <td>{!! $item['name'] !!}</td>
    	                                            <td class="">
                                                        @if(!empty($item['filename']))
                                                            <?php $file = sizeOfFileName($item['filename'],'60x60'); ?>
                                                            <img src="{!! Config('global.root_media').'brands/'.$file['path'].$file['filename'] !!}" alt="{!! $file['filename'] !!}">
                                                        @else
                                                            Trống
                                                        @endif    
                                                    </td>
    	                                            <td class="">{!! date("d-m-y H:i",strtotime($item->created_at)) !!}</td>
    	                                            <td class="">
    	                                                &nbsp;&nbsp;
    	                                                {!! loadAction($item->id,'brand') !!}
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
                                @include('cms.blocks.paginate', ['paginator' => $listBrand->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listBrand])
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection