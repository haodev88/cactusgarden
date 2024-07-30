@extends('cactus._include.master')
@section('title_page', 'Đặt hàng thành công')
@section('content')
    <!--Breadcrumb Area Start-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <div class="pb-50 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Đặt hàng thành công</h3>
                    <p class="mt-20">Mã đơn hàng của bạn <strong>{{ $orderCode }}</strong></p>
                    <p>Trân thành cám ơn bạn đã mua hàng ở shop chúng tôi.</p>
                    <div class="customer-care-info">
                        <strong>
                            <p>Nếu có bất kì điều gì thắc mắc, xin hãy gọi cho chúng tôi: <br>
                                <span class="hotline">0120 779 0670</span>
                            </p>
                        </strong>
                    </div>
                    <div class="buttons">
                        <div class="">
                            <a href="{{ route("home") }}" class="btn product-btn">Trang chủ</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
