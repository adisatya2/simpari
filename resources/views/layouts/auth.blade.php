<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('dist/img/Logo Hermina.ico') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>

<body class="hold-transition login-page">
    @yield('loginbox')

    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/') }}plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>

    <script src="{{ asset('/') }}plugins/popper/umd/popper.min.js"></script>
    <script src="{{ asset('/') }}plugins/popper/umd/popper-utils.min.js"></script>
</body>

</html>
