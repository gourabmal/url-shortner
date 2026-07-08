@php
    $info = \App\Helper\admin\siteInformation::siteInfo();
    \App\Helper\admin\siteInformation::configDetails($info);
@endphp

@php
    $dashboardRoute = dashboardRoute();
    $invitationRoute = invitationRoute();
    $shortUrlRoute = shortUrlRoute();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Admin</title>

    <link rel="icon" href="{{ asset('data/public/uploads/info/' . $info['favicon']) }}" type="image/gif" sizes="16x16">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Local Assets -->
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('data/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/dist/css/bootstrap-material-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('data/public/admin/dist/css/custom_admin.css') }}">

    <!-- CDNs -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        .main-header.navbar.navbar-expand.navbar-white.navbar-light .navbar-nav li.nav-item a.btn {
            color: #fff;
        }

        .brand-link .brand-image {
            background: #fff;
            border-radius: 0;
            object-fit: cover;
            max-width: 73px;
            max-height: 33px;
        }

        a.nav-link.btn.btn-primary {
            margin: 0 8px 0 5px;
        }

        .brand-link img {
            filter: brightness(0) invert(1);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="main_body_section">
    <div class="loader1" id="loader_run">
        <img src="{{ asset('data/public/loader/1.gif') }}">
    </div>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('data/public/uploads/info/' . $info['site_logo']) }}"
                alt="{{ config('app.name') }}" height="60" width="150">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="fa_bars_click">
                        <i class="fas fa-bars" onclick="siteMenuCheck()"></i>
                    </a>
                </li>
                <li class="nav-item" style="display: flex">
                    <div class="image-box" style="width: 40px; height: 40px; margin-right: 25px">
                        <a href="{{ route('common.profile', ['name' => Auth::user()['id']]) }}">
                            <img src="{{ asset('data/public/uploads/profile/' . Auth::user()['profile_picture']) }}"
                                alt=""
                                style="height: 100%; width: 100%; border-radius: 50%; object-fit: cover; border: 2px solid #767373">
                        </a>
                    </div>
                    <a class="nav-link btn btn-primary" data-toggle="modal" data-target="#modal-default"><i
                            class="fa fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        @include('common.layout.leftmenu')

        <!-- Main Content -->
        @yield('content')

        <footer class="main-footer text-center">
            <strong>{{ $info['copyright'] }}</strong>
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    @include('common.layout.all_modals')

    <!-- jQuery -->
    <script src="{{ asset('data/public/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI (Optional if used) -->
    <script src="{{ asset('data/public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Moment.js (Required for Tempus Dominus) -->
    <script src="{{ asset('data/public/admin/plugins/moment/moment.min.js') }}"></script>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('data/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Tempus Dominus Bootstrap 4 (DateTime Picker) -->
    <script src="{{ asset('data/public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>

    <!-- Chart.js -->
    <script src="{{ asset('data/public/admin/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Sparklines -->
    <script src="{{ asset('data/public/admin/plugins/sparklines/sparkline.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('data/public/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- jQuery Knob -->
    <script src="{{ asset('data/public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- Daterangepicker (Optional if used) -->
    <script src="{{ asset('data/public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('data/public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- OverlayScrollbars -->
    <script src="{{ asset('data/public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('data/public/admin/plugins/toastr/toastr.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('data/public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('data/public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Bootstrap Colorpicker -->
    <script src="{{ asset('data/public/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('data/public/admin/dist/js/custom_admin.js') }}"></script>
    <script src="{{ asset('data/public/admin/dist/js/adminlte.js') }}"></script>

    @stack('scripts')
    <script>
        window.onLoad = stopLoader();
        /*** Stop Loader ***/
        function stopLoader() {
            var menuClassCheck = localStorage.getItem("leftmenu_minimized");
            if (menuClassCheck == 1) {
                $("#fa_bars_click").click();
            }
            var redirectURL = localStorage.getItem('return_url');
            if (redirectURL != null) {
                localStorage.removeItem('return_url');
            }
            document.getElementById("loader_run").style.visibility = "hidden";
            @if (Session::has('session_success'))
                toastr.success('{{ Session::get('session_success') }}');
                {{ Session::put('session_success', null) }}
            @endif
        }
    </script>
</body>

</html>
