<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">
    <title>
        POS Frozen Food
    </title>
    <!--     Fonts and icons     -->
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>--}}
    <!-- Nucleo Icons -->
    <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet"/>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet"/>
    <link id="pagestyle" href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet"/>
</head>

<body class="g-sidenav-show bg-gray-100" style="background:white !important; ">
<div class="min-height-300 bg-dark position-absolute w-100"></div>


<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.components.top_navbar')
    <div class="" style="min-height: 750px;">
        @yield("content")
    </div>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            ,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                   target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                   target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                   target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                   target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="toast-container position-fixed top-0 bg-outline-dark  end-0 p-3">
        <div id="successToast" class="toast text-white text-bg-success" role="alert" aria-live="assertive"
             aria-atomic="true">
            <div class="toast-header bg-success text-white py-0 pt-2 rounded">
                <strong class="me-auto">Berhasil</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBodySuccess" style="text-transform: capitalize;">
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="failedToast" class="toast text-white text-bg-danger rounded" role="alert" aria-live="assertive"
             aria-atomic="true">
            <div class="toast-header bg-danger text-white py-0 pt-2 rounded">
                <strong class="me-auto">Peringatan!!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBodyFailed">
            </div>
        </div>
    </div>

</main>

<!--   Core JS Files   -->
<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
<script>

</script>

<script>
    function setOverlaySidenav() {
        document.getElementById('sidenav-main').classList.add("custom-overlay");
        document.getElementById('navbarBlur').classList.add("custom-overlay");
    }

    function unsetOverlaySidenav() {
        document.getElementById('sidenav-main').classList.remove("custom-overlay");
        document.getElementById('navbarBlur').classList.remove("custom-overlay");
    }
</script>
@if(session()->has('success') )
    <script>
        const toastLiveExample = document.getElementById('successToast')
        document.getElementById('toastBodySuccess').innerHTML = `{{ session()->get('success') }}  `
        const toast = new bootstrap.Toast(toastLiveExample)
        toast.options = {
            animation: true,
            autohide: true,
            delay: 10000,
        };
        toast.show();
    </script>
@endif
@if(session()->has('failed'))
    <script>
        const toastLiveExample = document.getElementById('failedToast')
        document.getElementById('toastBodyFailed').innerHTML = `@if(is_array(session()->get('failed')))
        @foreach(session()->get('failed') as $item) {{ $item[0] }} @endforeach
        @else{{session()->get('failed')}} @endif
        `
        const toast = new bootstrap.Toast(toastLiveExample)
        toast.options = {
            animation: true,
            autohide: true,
            delay: 10000,
        };
        toast.show();
    </script>
@endif
@stack("js")

</body>

</html>
