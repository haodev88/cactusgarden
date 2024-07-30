@extends('cms.master')
@section('title','Danh sách sản phẩm')
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
                            <h2>Danh sách sản phẩm</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.product.create') !!}">
                                    Thêm sản phẩm
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
                                            <th class="column-title">STT</th>
                                            <th class="column-title">SKU</th>
                                            <th class="column-title">Tên sản phẩm</th>
                                            <th class="column-title">Ảnh sản phẩm</th>
                                            <th class="column-title">Danh mục</th>
                                            <th class="column-title">Giá bán</th>
                                            <th class="column-title">Ngày tạo</th>
                                            <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{!! Route('searchproduct') !!}" method="get">                                       
                                           	<td colspan="2"><input value="@if(isset($get["txtSku"]) && $get["txtSku"]!=""){!!$get["txtSku"]!!}@endif" class="form-control" type="text" name='txtSku' placeholder="Nhập SKU cần tìm"></td>
                                           	<td><input value="@if(isset($get["txtName"]) && $get["txtName"]!="") {!!$get["txtName"]!!}@endif" class="form-control" type="text" name='txtName' placeholder="Nhập tên sản phẩm cần tìm"></td>
                                           	<td colspan="2">
                                           		<select name="sltCategory" class="select2_single form-control" placeholder="Chọn danh mục cần tìm">
                                           			<option value="">Chọn danh mục cần tìm</option>
                                                    @if(!empty($listCate))
                                                        {!! menuMulti($listCate,0,'---|',$defaultCate) !!}
                                                    @endif
                                           		</select>
                                           	</td>
                                           	<td colspan="2"><input value="@if(isset($get["txtPrice"]) && $get["txtPrice"]!=""){!!$get["txtPrice"]!!}@endif" class="form-control" type="text" name='txtPrice' placeholder="Nhập Giá bán cần tìm"></td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                    	@if (isset($listProduct) && $listProduct->count()!=0)
                                       		@foreach($listProduct as $item)
                                       			<?php $stt++; ?>
		                                        <tr class="even pointer">
		                                            <td>{!! $stt !!}</td>
		                                            <td>{!! $item->sku !!}</td>
		                                            <td>{!! $item->name !!}</td>
		                                            <td>
                                                        @if(!empty($item['default_image']))
                                                            <?php $file = sizeOfFileName($item['default_image'],'80x80'); ?>
                                                            <img src="{!! Config('global.media_url').$file['path'].$file['filename'] !!}"> 
                                                        @else
                                                            Trống
                                                        @endif      
                                                    </td>
		                                            <td>{!! $item->category->title !!}</td>
		                                            <td>{!! number_format($item->price,0,'.','.') !!} <sup>đ</sup></td>
		                                            <td>{!! date("d-m-y H:i",strtotime($item->created_at)) !!}</td>
		                                            <td>
			                                            {!! loadAction($item->id,'product') !!}
                                                	</td>
		                                        </tr>
		                                    @endforeach
                                        @else
                                            <tr class="even pointer">
                                                <td colspan="8" align="center">Không tồn tại dữ liệu</td>
                                            </tr>        
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listProduct->appends($append)]);
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listProduct])
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection