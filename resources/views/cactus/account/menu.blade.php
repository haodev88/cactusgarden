<?php $currentRouteName=\Request::route()->getName(); ?>
<div class="col-md-12 col-lg-2">
    <ul class="nav flex-column dashboard-list" role="tablist">
        <li><a class="nav-link {{ $currentRouteName ==  "account_dashboard" ? "active" : null }}" href="{{ route("account_dashboard") }}">Bảng điều khiển</a></li>
        <li><a class="nav-link {{ $currentRouteName ==  "my_account" ? "active" : null }}" href="{{ route("my_account") }}">Thông tin tài khoản</a></li>
        <li><a class="nav-link {{ $currentRouteName ==  "my_order" ? "active" : null }}" href="{{ route("my_order") }}">Thông tin đơn hàng</a></li>
        <li><a class="nav-link" href="{{ route("logout") }}">Đăng xuất</a></li>
    </ul>
</div>
