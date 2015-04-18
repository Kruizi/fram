<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ru"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Авторизация</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/metro.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style_responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style_default.css') }}" rel="stylesheet" id="style_color" />
    <link href="{{ asset('public/assets/uniform/css/uniform.default.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/gritter/css/jquery.gritter.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/jqvmap/jqvmap/jqvmap.css') }}" />
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}" />
</head>


	@yield('contentHome')
    <!-- BEGIN JAVASCRIPTS -->
    <script src="{{ asset('public/assets/js/jquery-1.8.3.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="{{ asset('public/assets/js/excanvas.js') }}"></script>
    <script src="{{ asset('public/assets/js/respond.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('public/assets/breakpoints/breakpoints.js') }}"></script>
    <script src="{{ asset('public/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}"></script>
    <script src="{{ asset('public/assets/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('public/assets/fullcalendar/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/assets/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/assets/gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/js/jquery.pulsate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/bootstrap-daterangepicker/date.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/uniform/jquery.uniform.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.blockui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            App.initLogin();
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
</html>
