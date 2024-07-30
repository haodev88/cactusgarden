<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="/cms/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/cms/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/cms/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- select2 -->
    <link href="/cms/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/cms/vendors/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/cms/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="/cms/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/cms/build/css/custom.css" rel="stylesheet">
    <link href="/cms/build/css/dev.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('cms.template.welcome')
                <br />
                <!-- sidebar menu -->
                @include('cms.template.left_menu')
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        @include('cms.template.top_menu')
        <!-- /top navigation -->
        <!-- page content -->
        @yield('main_content')
        <!-- /page content -->
        <!-- footer content -->
        @include('cms.template.footer')
        <!-- /footer content -->
    </div>
</div>
<!-- jQuery -->
    <script src="/cms/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/cms/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/cms/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/cms/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="/cms/vendors/iCheck/icheck.min.js"></script>
    <!-- Select2 -->
    <script src="/cms/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- library form-validate -->
    <script src="/cms/vendors/bootstrap-validator-master/js/validator.js"></script>
    <!-- Ckeditor -->
    <script type="text/javascript" src="/cms/build/ckeditor/ckeditor.js"></script>
    <script src="/cms/js/moment/moment.min.js"></script>
    <!-- datepicker -->
    <script src="/cms/js/datepicker/daterangepicker.js"></script>
    <script src="/cms/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- call script -->
    @yield('call_library_js')
    <!-- Custom Theme Scripts -->
    <script src="/cms/build/js/custom.js"></script>
    <script src="/cms/build/js/dev.js"></script>
    <script src="/cms/build/js/validate-form.js"></script>
    @yield('javascript')
</body>
</html>