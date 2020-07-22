<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')|{{ config("app.name") }}</title>
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/main-rtl.css') }}">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
                <h1>{{ config('app.name') }}</h1>
            </div>
            @yield('content')
        </section>
        <!-- Essential javascripts for application to work-->
        <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/main.js') }}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('dashboard/js/plugins/pace.min.js') }}"></script>
        <script type="text/javascript">
            // Login Page Flipbox control
            $('.login-content [data-toggle="flip"]').click(function() {
                $('.login-box').toggleClass('flipped');
                return false;
            });
        </script>
    </body>
</html>
