@extends('cactus._include.master')
@section('title_page', 'Chi tiết đơn hàng')
@section('content')
    @include("cactus.account.breadcrumb")
    <div class="my-account white-bg">
        <div class="container">
            <div class="account-dashboard">
                <div class="row">
                    @include('cactus.account.menu')
                    <div class="col-md-12 col-lg-10">
                        <!-- Tab panes -->
                        <div class="dashboard-content">
                            <div id="orders">
                                <h3>Chi tiết đơn hàng</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th>SKU</th>
                                                <th>SL</th>
                                                <th>Giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t=0; ?>
                                            @foreach ($orderDetail as $_item)
                                                <tr>
                                                    <td>{{ $_item->product_name }}</td>
                                                    <td>{{ $_item->sku }}</td>
                                                    <td>{{ $_item->quanlity }}</td>
                                                    <td>{!! currentPriceFormat($_item->price) !!}</td>
                                                    <td>{!! currentPriceFormat($_item->price*$_item->quanlity) !!}</td>
                                                </tr>
                                                <?php $t+= $_item->price*$_item->quanlity; ?>
                                            @endforeach
                                            <tr>
                                                <td align="right" colspan="4">Tổng tiền</td>
                                                <td colspan="1"><strong>{!! currentPriceFormat($t) !!}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
