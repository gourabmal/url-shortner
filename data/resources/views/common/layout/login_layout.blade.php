@php
    $info = \App\Helper\admin\siteInformation::siteInfo();
    \App\Helper\admin\siteInformation::configDetails($info);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Log in</title>

    <link rel="icon" href="{{ asset('data/public/uploads/info/' . $info['favicon']) }}" type="image/gif" sizes="16x16">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/dist/css/custom_admin.css') }}">
</head>

<body class="hold-transition login-page" ng-app="myapp">
    <div class="loader1" id="loader_run">
        <img src="{{ asset('data/public/loader/1.gif') }}">
    </div>

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('admin_login') }}">
                @if (!empty($info['site_logo']))
                    <img src="{{ asset('data/public/uploads/info/' . $info['site_logo']) }}" alt="{{ $info['site_name'] }}"
                        style="max-height:60px; width:auto;">
                @else
                    <b>{{ $info['site_name'] }}</b>
                @endif
            </a>
        </div>
        @yield('login_layout')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('data/public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/dist/js/custom_login.js') }}"></script>
    <script src="{{ asset('data/public/admin/dist/js/alerts.js') }}"></script>

    @stack('login_script')

    <script>
        window.onload = stopLoader;

        function stopLoader() {
            document.getElementById("loader_run").style.visibility = "hidden";
        }
    </script>
</body>

</html>
