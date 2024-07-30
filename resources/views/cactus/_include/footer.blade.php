<hr />
<footer class="main-footer">
    <div class="main-footer--bottom">
        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                        <div class="footer-col footer-block">
                            <div class="footer-content">
                                <p>
                                    <img src="{{ URL::to("/") }}/cactus/img/logo/logo_footer.png" alt="logo-footer" border="0">
                                </p>
                                <div class="social-list">
                                    <a href="https://www.facebook.com/cactusdieuduong" class="fa fa-facebook"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                        <div class="footer-col footer-link">
                            <h4 class="footer-title">Danh mục</h4>
                            <div class="footer-content toggle-footer">
                                <ul>
                                    <li class="item"><a href="{{ route("home") }}">Trang chủ</a></li>
                                    <li class="item"><a href="{{ route("about-us") }}">Về chúng tôi</a></li>
                                    <li class="item"><a href="{{ route("contact") }}">Liên hệ</a></li>
                                    <li class="item"><a href="{{ route("get-login") }}">Đăng nhập</a></li>
                                    <li class="item"><a href="{{ route("blog") }}">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                        <div class="footer-col footer-block">
                            <h4 class="footer-title">Thông tin liên hệ</h4>
                            <div class="footer-content toggle-footer">
                                <ul>
                                    <li><span>Địa chỉ:</span> {{ Config("global.infomation_shop.address") }}</li>
                                    <li><span>Điện thoại:</span> {{ Config("global.infomation_shop.hotline") }}</li>
                                    <li><span>Mail:</span> {{ Config("global.infomation_shop.email") }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                        <div class="footer-col footer-block">
                            <h4 class="footer-title">
                                FANPAGE
                            </h4>
                            <div class="footer-content">
                                <!-- Facebook widget -->
                                <div class="footer-static-content">
                                    <div id="fb-root"></div>
                                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=1824588781199042&autoLogAppEvents=1"></script>
                                    <div class="fb-page" data-href="https://www.facebook.com/cactusdieuduong" data-tabs="" data-width="270" data-height="214" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/cactusdieuduong" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/cactusdieuduong">Cactus Garden</a></blockquote></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="main-footer--copyright">
        <div class="container">
            <div class="main-footer--border">
                <p>Copyright &copy; <a href="javascript:void(0);">cactusgarden.</a> All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
