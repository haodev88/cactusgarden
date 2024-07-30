@extends('cms.master')
@section('title','Chỉnh sửa đơn hàng')
@section('main_content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <!-- left content -->
                <div class="col-md-12 col-xs-12">
                    <div class="x_panel">
                        <h2 style="text-align: center;">Thông tin đơn hàng</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- left content -->
                <div class="col-md-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Trạng thái đơn hàng</h2>
                            <div class="pull-right">
                                <select id="sltOrderStatus" name="sltOrderStatus" class="form-control select2_single">
                                    <option value="0">Chọn</option>
                                    @if(!empty($orderStatus))
                                        @foreach($orderStatus as $item)
                                            @if($item['id'] == $order['dt_order_status_id'])
                                                <option selected="selected" value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @else
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form_wizard wizard_horizontal">
                                <ul class="wizard_steps anchor" id="result_html_tracking">
                                    {!! $order['order_status']['html_tracking'] !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- top -->
            <form name="formDeliveryInfo" action="javascript:void(0);" class="form-horizontal form-label-left">
                <div class="row">
                    <!-- left content -->
                    <div class="col-md-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Thông tin người đặt hàng</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Họ tên</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $order['order_delivery']['name_delivery_from']  }}" type="text" name="txtNameFrom" class="form-control" placeholder="Họ tên">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $order['order_delivery']['phone_delivery_from'] }}" type="text" name="txtPhoneFrom" class="form-control" placeholder="Số điện thoại">                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $order['order_delivery']['order_email'] }}" type="text" name="txtEmailFrom" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $order['order_delivery']['address_from']  }}" type="text" name="txtAddressFrom" class="form-control" placeholder="Địa chỉ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tỉnh/Thành Phố</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="sltCityFrom" name="sltCityFrom" class="form-control select2_single">
                                            <option value="0">Chọn</option>
                                            @if (!empty($province))
                                                @foreach($province as $item)
                                                    @if ($item['provinceid'] == $order['order_delivery']['dt_provinceid_from'])
                                                        <option selected="selected" value="{{ $item['provinceid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                    @else
                                                        <option value="{{ $item['provinceid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Quận/Huyện</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="sltDistrictFrom" class="form-control select2_single">
                                            <option value="0">Chọn</option>
                                            @if (!empty($districtFrom))
                                                @foreach($districtFrom as $item)
                                                    @if ($item['districtid'] == $order['order_delivery']['dt_districtid_from'])
                                                        <option selected="selected" value="{{ $item['districtid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                    @else
                                                        <option value="{{ $item['districtid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Phường/Xã</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="sltWardFrom" class="form-control select2_single">
                                            <option value="">Chọn</option>
                                            @if (!empty($wardFrom))
                                                @foreach($wardFrom as $item)
                                                    @if ($item['wardid'] == $order['order_delivery']['dt_wardid_from'])
                                                        <option selected="selected" value="{{ $item['wardid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                    @else
                                                        <option value="{{ $item['wardid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /left content -->

                    <!-- right content -->
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="x_panel" style="height: 409px;">
                            <div class="x_title">
                                <h2>Thông tin người nhận hàng</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Họ tên</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input value="{{ $order['order_delivery']['name_delivery_to']  }}" type="text" name="txtNameTo" class="form-control" placeholder="Họ tên">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input value="{{ $order['order_delivery']['phone_delivery_to']  }}" type="text" name="txtPhoneTo" class="form-control" placeholder="Số điện thoại">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input value="{{ $order['order_delivery']['address_to']  }}" type="text" name="txtAddressTo" class="form-control" placeholder="Địa chỉ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tỉnh/Thành Phố</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="sltCityTo" id="sltCityTo" class="form-control select2_single">
                                                <option value="0">Chọn</option>
                                                @if (!empty($province))
                                                    @foreach($province as $item)
                                                        @if ($item['provinceid'] == $order['order_delivery']['dt_provinceid_to'])
                                                            <option selected="selected" value="{{ $item['provinceid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                        @else
                                                            <option value="{{ $item['provinceid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Quận/Huyện</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="sltDistrictTo" class="form-control select2_single">
                                                <option value="">Chọn</option>
                                                @if (!empty($districtTo))
                                                    @foreach($districtTo as $item)
                                                        @if ($item['districtid'] == $order['order_delivery']['dt_districtid_to'])
                                                            <option selected="selected" value="{{ $item['districtid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                        @else
                                                            <option value="{{ $item['districtid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phường/Xã</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="sltWardTo" class="form-control select2_single">
                                                <option value="">Chọn</option>
                                                @if (!empty($wardTo))
                                                    @foreach($wardTo as $item)
                                                        @if ($item['wardid'] == $order['order_delivery']['dt_wardid_to'])
                                                            <option selected="selected" value="{{ $item['wardid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                        @else
                                                            <option value="{{ $item['wardid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /right content -->
                </div>
                <!-- /top -->
                <div class="row">
                    <!-- left content -->
                    <div class="col-md-12 col-xs-12">
                        <div class="x_panel">
                            <div>
                                <textarea name="orderNote" class="form-control" rows="6" placeholder="Ghi chú khách hàng">{{ $order['order_note'] }}</textarea>
                            </div>
                            <br />
                            <div class="text-center">
                                <button id="btn-edit-info" class="btn btn-success btn-sm btn-add">
                                    Cập nhật thông tin giao nhận
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- hidden field -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- /hidden field -->
            </form>

            <!-- bottom-->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Sản phẩm đặt mua</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title" style="width:5%;">STT</th>
                                            <th class="column-title">SKU</th>
                                            <th class="column-title">Tên sản phẩm</th>
                                            <th class="column-title">Thuộc tính</th>
                                            <th class="column-title">Giá</th>
                                            <th class="column-title">Số lượng</th>
                                            <th class="column-title">Tổng tiền</th>
                                            <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = $total = 0;?>
                                        @if(!empty($order['order_detail']))
                                            @foreach($order['order_detail'] as $item)
                                                <?php
                                                    $stt++;
                                                    $t = $item['quanlity']*$item['price'];
                                                    $total+=$t;
                                                ?>
                                                <tr class="even pointer">
                                                    <td class="">{{ $stt }}</td>
                                                    <td class="">{{ $item['sku'] }}</td>
                                                    <td class="">{{ $item['product_name'] }}</td>
                                                    <td class="">
                                                        @if($item['attribute'] == '')
                                                            Trống
                                                        @else
                                                            {{ $item['attribute'] }}
                                                        @endif
                                                    </td>
                                                    <td class="">{{ number_format($item['price'],0,'.','.') }} <sup>đ</sup></td>
                                                    <td class=""><input class="width_50" type="number" value="{{ $item['quanlity'] }}"></td>
                                                    <td class="">{{ number_format($t,0,'.','.') }} <sup>đ</sup></td>
                                                    <td class="">
                                                        <a id="edit-quanlity" data-id="{{ $item['id'] }}" href="{{ route('editQuanlity') }}" class="btn btn-info btn-xs">
                                                            <i class="fa fa-pencil"></i> Sửa
                                                        </a>
                                                        <a onclick="return false;" id="delete-item" data-id="{{ $item['id'] }}" href="javascript:void(0);" class="btn btn-danger btn-xs">
                                                            <i class="fa fa-trash-o"></i> Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <a onclick="$('div#modal-add-product').modal('show');" class="btn btn-success btn-sm btn-add" href="javascript:void(0);">
                                        Thêm Sản phẩm vào đơn hàng
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /bottom-->

            <!-- total -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tổng tiền đơn hàng</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-bordered" style="width:40%;">
                                <thead>
                                    <tr>
                                        <th>Tổng tiền sản phẩm</th>
                                        <td>{{ number_format($total,0,'.','.') }} <sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <th>Tổng Tiền</th>
                                        <td>{{ number_format($total,0,'.','.') }} <sup>đ</sup></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /total -->
        </div>
    </div>

    <!-- modal -->
    <div id="modal-add-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form name="form-add-product" class="form-horizontal form-label-left">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Thêm sản phẩm vào đơn hàng</h4>
                    </div>
                    <div class="modal-body">
                        <div id="testmodal" style="padding: 5px 20px;">
                            <form id="antoform" class="form-horizontal calender" role="form">
                                <div class="form-group" id="append_after">
                                    <label class="col-sm-3 control-label">SKU sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="txtSku" name="txtSku">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Số lượng</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="txtQuanlity" name="txtQuanlity">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center;">
                        <button id="btn-add-product-action" type="button" class="btn btn-success btn-sm btn-add">Thêm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/modal -->
@endsection
@section('javascript')
    @include('cms.order.javascript')
@endsection
