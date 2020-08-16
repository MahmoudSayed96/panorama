<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta name="description" content="">
        <!-- Twitter meta-->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:site" content="@YOURSITE">
        <meta property="twitter:creator" content="@YOURSITE">
        <!-- Open Graph Meta-->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="SITENAME">
        <meta property="og:title" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <meta property="og:description" content="">
        <title>@yield('title')|{{ config("app.name") }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/main-rtl.css') }}">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
        @stack('styles')
    </head>
    <body class="app sidebar-mini">
        @include('admin.includes._header')
        @include('admin.includes._sidebar')
        <main class="app-content">
            @yield('content')
        </main>
        <!-- Essential javascripts for application to work-->
        <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/main.js') }}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('dashboard/js/plugins/pace.min.js') }}"></script>
        <!-- The javascript plugin to datatables-->
        <script src="{{ asset('dashboard/js/plugins/jquery.dataTables-ar.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/plugins/dataTables.bootstrap-ar.min.js') }}"></script>
        <!-- The javascript plugin to notify-->
        <script src="{{ asset('dashboard/js/plugins/bootstrap-notify.min.js') }}"></script>
        <!-- The javascript plugin to sweetAlert-->
        <script src="{{ asset('dashboard/js/plugins/bootstrap-notify.min.js') }}"></script>
        <!-- The javascript plugin to select-->
        <script src="{{ asset('dashboard/js/plugins/sweetalert.min.js') }}"></script>
        <!-- Page specific javascripts-->
        <script type="text/javascript" src="{{ asset('dashboard/js/plugins/chart.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#dt').DataTable();
                // Image preview
                $("#imgInp").change(function() {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]); // convert to base64 string
                });
            });
        </script>
        @stack('scripts')
    </body>
</html>
