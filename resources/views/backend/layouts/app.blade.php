<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('backend/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["/backend/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.min.css') }}" />


    <style>
        .body-content {
            margin-top: 100px;
            margin-left: 50px;
        }
    </style>

</head>

<body>
    <div class="wrapper">

        {{--  Sidebar  --}}
        @include('backend.includes.sidebar')


        <div class="main-panel">

            {{-- ========  header ========== --}}
            @include('backend.includes.header')



            {{-- ========  content ========== --}}
            <div class="h-100 body-content px-5 ">
                <div class="pb-5">
                    @yield('content')
                </div>
            </div>


            {{-- =========  footer ========= --}}
            @include('backend.includes.footer')


        </div>
    </div>
    <!-- Core JS Files -->
    <script src="{{ asset('/backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/chart.js/chart.min.js') }}"></script> --}}

    <!-- jQuery Sparkline -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script> --}}

    <!-- Chart Circle -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/chart-circle/circles.min.js') }}"></script> --}}

    <!-- Datatables -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/datatables/datatables.min.js') }}"></script> --}}

    <!-- Bootstrap Notify -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

    <!-- jQuery Vector Maps -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/assets/js/plugin/jsvectormap/world.js') }}"></script> --}}

    <!-- Google Maps Plugin -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/gmaps/gmaps.js') }}"></script> --}}

    <!-- Sweet Alert -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}

    <!-- Kaiadmin JS -->
    <script src="{{ asset('backend/assets/js/kaiadmin.min.js') }}"></script>

</body>

</html>
