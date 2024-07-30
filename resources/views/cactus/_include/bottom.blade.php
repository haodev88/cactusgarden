<?php $version = env("VERSION_CSS","1.1") ?>
<script type="text/javascript">
    var mediaPath = "{{ URL::to("/").Config("global.media_url") }}"
</script>
@yield('js_before')
<!--All Js Here-->
<!--Jquery 1.12.4-->
{!! Html::script('cactus/js/vendor/jquery-1.12.4.min.js') !!}
<!--Popper-->
{!! Html::script('cactus/js/popper.min.js') !!}
<!--Bootstrap-->
{!! Html::script('cactus/js/bootstrap.min.js') !!}
<!--Plugins-->
{!! Html::script('cactus/js/plugins.js?v='.$version) !!}
<!--Main Js-->
{!! Html::script ('cactus/js/main.js?v='.$version) !!}
{!! Html::script('cactus/js/validator.js') !!}
<!-- lib Js -->
{!! Html::script('cactus/js/lib/function.js?v='.$version) !!}
{!! Html::script('cactus/js/class/shopping.js') !!}
{!! Html::script('cactus/js/class/area.js?v='.$version) !!}
{!! Html::script('cactus/js/proccess-cart.js?v='.$version) !!}
@yield('js')

<script id="header-cart" type="text/x-handlebars-template">
   {!! headerCart() !!}
</script>

</body>
</html>
