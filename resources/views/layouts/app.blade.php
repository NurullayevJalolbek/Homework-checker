<!doctype html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/"
    data-template="vertical-menu-template">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style>
        .show.menu-item.active .menu-link {
            background-color: #3498db;
            /* Ko'k rang */
            color: #fff;
            /* Oq rangdagi matn */
        }

        .menu-item.active .menu-icon {
            color: #fff;
            /* Ikonkaning rangini oq qilish */
        }
    </style>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.sidebar')

            <div class="layout-page">
                @include('layouts.top-navbar')
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @yield('activePage')
                            @yield('content')
                            <div aria-live="polite" aria-atomic="true" class="position-fixed top-50 start-50 translate-middle p-3" style="z-index: 9999;">
                                @if (session('success'))
                                <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            {{ session('success') }}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endif

                                @if (session('error'))
                                <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            {{ session('error') }}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endif
                            </div>


                        </div>
                    </div>
                    @include('layouts.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>

                    <!-- Overlay -->
                    <div class="layout-overlay layout-menu-toggle"></div>
                    <div class="drag-target"></div>

                    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
                    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
                    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
                    <script src="{{ asset('assets/js/main.js') }}"></script>
                    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
                    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
                    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

                </div>
                <div class="drag-target"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.forEach(function(toastEl) {
                new bootstrap.Toast(toastEl, {
                    delay: 1500
                }).show();
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelectorAll('.menu-toggle');

            menuToggle.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const submenu = this.nextElementSibling;
                    if (submenu.classList.contains('show')) {
                        submenu.classList.remove('show');
                    } else {
                        submenu.classList.add('show');
                    }
                });
            });
        });
    </script>

</body>

</html>