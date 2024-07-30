<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>cactusgarden - @yield('title_page')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield("og")
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to("/") }}/cactus/img/favicon.ico">
    <!--All Css Here-->
    <!-- Elegant Icon Font CSS-->
<?php $version = env("VERSION_CSS","1.1"); ?>
{!! Html::style("cactus/css/elegant_font.css") !!}
<!-- Font Awesome CSS-->
{{ Html::style("cactus/css/font-awesome.min.css") }}
<!-- Ionicons CSS-->
{{ Html::style("cactus/css/ionicons.min.css") }}
<!-- Bootstrap CSS-->
{{ Html::style("cactus/css/bootstrap.min.css") }}
<!-- Plugins CSS-->
{{ Html::style("cactus/css/plugins.css?v=$version") }}
<!-- Style CSS -->
{{ Html::style("cactus/style.css?v=$version") }}
<!-- Responsive CSS -->
{{ Html::style("cactus/css/responsive.css?v=$version") }}
<!-- Modernizr Js -->
{!! Html::script('cactus/js/vendor/modernizr-2.8.3.min.js')  !!}

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
