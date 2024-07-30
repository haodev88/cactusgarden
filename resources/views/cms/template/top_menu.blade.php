<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="">{{ Auth::user()->username }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{ route('admin_shop.user.show',['id'=>Auth::user()->id]) }}"> Thông tin cá nhân</a></li>
                        <li><a href="javascript:;"><span>Cấu hình</span></a></li>
                        <li><a href="{!! Route('getLogout') !!}"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>