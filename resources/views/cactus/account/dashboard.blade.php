@extends('cactus._include.master')
@section('title_page', 'Bảng điều khiển')
@section('content')
    @include("cactus.account.breadcrumb")
    <div class="my-account white-bg">
        <div class="container">
            <div class="account-dashboard">
                <div class="row">
                    @include('cactus.account.menu')
                    <div class="col-md-12 col-lg-10">
                        <div class="tab-content dashboard-content">
                            <div id="dashboard" class="tab-pane fade show active">
                                <h3>Bảng điều khiển </h3>
                                <p>Từ bảng điều khiễn, bạn có thể dễ dàng thay đổi thông tin cá nhân hoặc xem lại đơn hàng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
