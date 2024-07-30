
@extends('cms.master')
@section('title','Quản lí đơn hàng')
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
                            <h2>Danh sách các đơn hàng</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title" style="width:16%;">Mã Đơn Hàng</th>
                                        <th class="column-title">Khách hàng</th>
                                        <th class="column-title">Email</th>
                                        <th class="column-title" style="width:15%;">Số điện thoại</th>
                                        <th class="column-title">Ngày đặt hàng </th>
                                        <th class="column-title no-link last" style="width:15%"><span class="nobr">Hành động</span></th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <form action="{{ route('searchOrder') }}" method="get">
                                            <td colspan="1"><input value="<?= isset($append['ordercode']) ? $append['ordercode'] :'' ?>" placeholder="Nhập mã đơn hàng cần tìm" name="ordercode" type="text" class="form-control" /></td>
                                            <td colspan="1"><input value="<?= isset($append['name']) ? $append['name'] :'' ?>" placeholder="Nhập tên khách hàng" name="name" type="text" class="form-control" /></td>
                                            <td colspan="1"><input value="<?= isset($append['email']) ? $append['email'] :'' ?>" placeholder="Nhập email viên cần tìm" name="email" type="text" class="form-control" /></td>
                                            <td colspan="1"><input value="<?= isset($append['phone']) ? $append['phone'] :'' ?>" placeholder="Nhập số điện thoại cần tìm" name="phone" type="text" class="form-control" /></td>
                                            <td colspan="1">
                                                <fieldset>
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <div class="input-prepend input-group">
                                                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                                <input value="<?= isset($append['date']) ? $append['date'] :'' ?>" placeholder="Ngày đặt hàng" type="text" name="date" id="single_cal1" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @if(!$listOrder->isEmpty())
                                            @if (!isset($isIndex))
                                                @foreach($listOrder as $item)
                                                    <tr class="even pointer">
                                                        <td>{{ $item->order_code }}</td>
                                                        <td>{{ $item->name_delivery_from}}</td>
                                                        <td>{{ $item->order_email }}</td>
                                                        <td>{{ $item->phone_delivery_from }}</td>
                                                        <td>{{ date('d-m-y H:i:s',strtotime($item->created_at)) }}</td>
                                                        <td>{!! loadAction($item->id,'order')  !!}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach($listOrder as $item)
                                                    <tr class="even pointer">
                                                        <td>{{ $item->order_code }}</td>
                                                        <td>{{ $item['orderDelivery']['name_delivery_from'] }}</td>
                                                        <td>{{ $item['orderDelivery']['order_email'] }}</td>
                                                        <td>{{ $item['orderDelivery']['phone_delivery_from'] }}</td>
                                                        <td>{{ date('d-m-y H:i:s',strtotime($item->created_at)) }}</td>
                                                        <td>{!! loadAction($item->id,'order')  !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listOrder->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listOrder])
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