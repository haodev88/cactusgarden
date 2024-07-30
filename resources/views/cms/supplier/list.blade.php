@extends('cms.master')
@section('title','Danh sách các nhà cung cấp')
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
                            <h2>Danh sách các nhà cung cấp</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.supplier.create') !!}">
                                    Thêm nhà cung cấp
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
                                            <th class="column-title">Nhà cung cấp </th>
                                            <th class="column-title">Nhân viên thu mua </th>
                                            <th class="column-title">Ảnh đại diện </th>
                                            <th class="column-title">Ngày tạo </th>
                                            <th class="column-title"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{!! Route('searchsupplier') !!}" method="get">                                       
                                            <td colspan="2">
                                                <input value="<?= isset($input['suppliername']) ? $input['suppliername'] : '' ?>" placeholder="Nhập thương hiệu cần tìm" name="suppliername" type="text" class="form-control" />
                                            </td>
                                            <td colspan="3">
                                                <select class="select2_single form-control" name="sltBuyer">
                                                    <option value="">Chọn</option>
                                                    @foreach($listBuyer as $item)
                                                        @if(isset($input['sltBuyer']) && ($item['id'] == $input['sltBuyer']))
                                                            <option selected="selected" value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                                        @else
                                                            <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>    
                                                        @endif
                                                    @endforeach    
                                                </select>
                                            </td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @if($listSupplier->count() !=0 )
                                            @foreach ($listSupplier as $item)
    	                                        <?php $stt++; ?>
    	                                        <tr class="even pointer">
    	                                            <td class="">{!! $stt !!}</td>
    	                                            <td>{!! $item['name'] !!}</td>
                                                    <td>{!! isset($item->buyer->name) ? $item->buyer->name : ''  !!}</td>
    	                                            <td class="">
                                                        @if(!empty($item['filename']))
                                                            <?php $file = sizeOfFileName($item['filename'],'60x60'); ?>
                                                            <img src="{!! Config('global.root_media').'suppliers/'.$file['path'].$file['filename'] !!}" alt="{!! $file['filename'] !!}">
                                                        @else
                                                            Trống
                                                        @endif    
                                                    </td>
    	                                            <td class="">{!! date("d-m-y H:i",strtotime($item->created_at)) !!}</td>
    	                                            <td class="">
    	                                                &nbsp;&nbsp;
                                                        {!! loadAction($item->id,'supplier') !!}
    	                                            </td>
    	                                        </tr>
                                            @endforeach
                                        @else
                                            <tr class="even pointer">
                                                <td colspan="6" align="center">Dữ liệu không tồn tại</td>
                                            </tr>       
                                        @endif    
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listSupplier->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listSupplier])
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection