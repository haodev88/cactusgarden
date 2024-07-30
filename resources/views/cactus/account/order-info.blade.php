@extends('cactus._include.master')
@section('title_page', 'Đơn hàng')
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
                                <h3>Đơn hàng</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if($orders->count() > 0)
                                                @foreach($orders as $_item)
                                                    <?php $stt++; ?>
                                                    <tr>
                                                        <td>{{ $stt }}</td>
                                                        <td>{{ $_item->order_code }}</td>
                                                        <td>{{ $_item->created_at }}</td>
                                                        <td>{{ $_item->name }}</td>
                                                        <td>{!! currentPriceFormat($_item->total_amount) !!}</td>
                                                        <td><a class="view" href="{{ route("my_order_detail", ["id"=>$_item->id]) }}">Xem</a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">Dữ liệu không tồn tại</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('cactus._include.paginate', ['paginator' => $orders])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
