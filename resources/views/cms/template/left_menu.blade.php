<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>CMS</h3>
        <ul class="nav side-menu">
            <li><a href="{!! Route('index') !!}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a><i class="fa fa-users"></i> Quản lý thành viên <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{!! Route('admin_shop.user.index') !!}">Quản trị viên</a></li>
                    <li><a href="{!! Route('admin_shop.buyer.index') !!}">Nhân viên thu mua</a></li>
                    <li><a href="{!! Route('admin_shop.customer.index') !!}">Khách hàng</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-cog"></i> Quản lý thuộc tính <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{!! Route('admin_shop.option-group.index') !!}">Nhóm thuộc tính</a></li>
                    <li><a href="{!! Route('admin_shop.option.index') !!}">Thuộc tính</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-object-group"></i> Quản lý nhóm<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{!! Route('admin_shop.group.index') !!}">Nhóm vai trò</a></li>
                    <li><a href="{!! Route('admin_shop.role.index') !!}">Nhóm quyền</a></li>
                </ul>
            </li>
            <li><a href="{!! Route('admin_shop.banner.index') !!}"><i class="fa fa-picture-o"></i> Quản lý banner</a></li>
            <li><a href="{!! Route('admin_shop.blog.index') !!}"><i class="fa fa-file-o"></i> Quản lý bài viết</a></li>
            <li><a href="{!! Route('admin_shop.order.index') !!}"><i class="fa fa-inbox"></i> Quản lý đơn hàng</a></li>
            <li><a href="{!! Route('admin_shop.category.index') !!}"><i class="fa fa-book"></i> Quản lý danh mục</a></li>
            <li><a href="{!! Route('admin_shop.product.index') !!}"><i class="fa fa-product-hunt" ></i> Quản lý sản phẩm</a></li>
            <li><a href="{!! Route('admin_shop.brand.index') !!}"><i class="fa fa-bold" ></i> Quản lý thương hiệu</a></li>
            <li><a href="{!! Route('admin_shop.supplier.index') !!}"><i class="fa fa-scribd" ></i> Quản lý nhà cung cấp</a></li></li>
            <li><a href="{!! Route('admin_shop.contact.index') !!}"><i class="fa fa-comment" ></i> Quản lý liên hệ khách hàng</a></li></li>
            <li><a href="{!! Route('admin_shop.page.index') !!}"><i class="fa fa-laptop" ></i>Landing Page</a></li></li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
