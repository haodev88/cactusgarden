@extends('cms.master')
@section('title','Quản lý khách hàng')
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
                            <h2>Danh sách các Khách hàng</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{{ route('admin_shop.customer.create') }}">
                                    Thêm Khách hàng
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
                                            <th class="column-title" style="width:5%;">STT</th>
                                            <th class="column-title">Họ tên</th>
                                            <th class="column-title">Email</th>
                                            <th class="column-title" style="width:15%;">Số điện thoại</th>
                                            <th class="column-title">Ngày tạo </th>
                                            <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{{ route('searchCumtomer') }}" method="get">
                                            <td colspan="2"><input value="<?= isset($input['name']) ? $input['name'] : '' ?>" placeholder="Nhập tên Khách hàng cần tìm" name="name" type="text" class="form-control" /></td>
                                            <td colspan="1"><input value="<?= isset($input['email']) ? $input['email'] : '' ?>" placeholder="Nhập email viên cần tìm" name="email" type="text" class="form-control" /></td>
                                            <td colspan="1"><input value="<?= isset($input['phone']) ? $input['phone'] : '' ?>" placeholder="Nhập số điện thoại cần tìm" name="phone" type="text" class="form-control" /></td>
                                            <td colspan="1">
                                                <fieldset>
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <div class="input-prepend input-group">
                                                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                                <input value="<?= isset($input['date']) ? $input['date'] : '' ?>" placeholder="Ngày tạo" type="text" name="date" id="single_cal1" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                    	@if(!empty($listCustomer))
                                    		@foreach($listCustomer as $item)
                                    			<?php $stt++; ?>
		                                        <tr class="even pointer">
		                                            <td>{{ $stt }}</td>
		                                            <td>{{ $item->name }}</td>
		                                            <td>{{ $item->email }}</td>
		                                            <td>{{ $item->phone }}</td>
		                                            <td>{!! date("d-m-y H:i",strtotime($item->created_at)) !!}</td>
		                                            <td>{!! loadAction($item->id,'customer') !!}</td>
		                                        </tr>
	                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listCustomer->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listCustomer])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection
@section('javascript')
    <script type="text/javascript">
        $(function() {
            createDatePicker('single_cal1');
        });
    </script>
@endsection