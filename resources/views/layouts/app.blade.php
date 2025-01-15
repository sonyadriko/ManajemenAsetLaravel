<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader -->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- SimpleBar CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/simplebar@5.3.1/dist/simplebar.min.css" rel="stylesheet" />

    <!-- Perfect Scrollbar CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/css/perfect-scrollbar.css" rel="stylesheet" />

    <!-- MetisMenu CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/metismenu@3.0.7/dist/metisMenu.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />

    <title>@yield('title', 'Dashboard')</title>
</head>

<body>

    <!-- Start Wrapper -->
    <div class="wrapper d-flex flex-column min-vh-100">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End Sidebar -->

        <!-- Top Header -->
        @include('layouts.header')
        <!-- End Top Header -->

        <!-- Page Content Wrapper -->
        <div class="page-content-wrapper flex-grow-1">
            <!-- Page Content -->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- End Page Content -->
        </div>
        <!-- End Page Content Wrapper -->

        <!-- Footer -->
        @include('layouts.footer')
        <!-- End Footer -->
    </div>
    <!-- End Wrapper -->

    <!-- JS Files -->
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SimpleBar CDN -->
    <script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.1/dist/simplebar.min.js"></script>

    <!-- MetisMenu CDN -->
    <script src="https://cdn.jsdelivr.net/npm/metismenu@3.0.7/dist/metisMenu.min.js"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
