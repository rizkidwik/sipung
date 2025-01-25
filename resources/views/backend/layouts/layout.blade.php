<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ env('APP_NAME') }} </title>


    <link rel="shortcut icon" href="{{ route('configuration.logo') }}" type="image/x-icon">

    @stack('before-style')
    <link rel="stylesheet" href="{{ asset('custom/assets/css/styles.min.css') }}">
    {{-- DataTables --}}
    <link rel="stylesheet"
        href="{{ asset('custom/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('custom/assets/extensions/datatables.net-bs5/css/dataTables.responsive.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/css/custom.css') }}">

    @stack('after-style')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('backend.layouts.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="text-black fs-3 me-3">{{ auth()->user()->name }}</span>
                                    <img src="{{ auth()->user()->avatar }}" alt="" width="35"
                                        height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('profile.edit') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button
                                                    class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('before-script')
    <script src="{{ asset('custom/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('custom/assets/libs/jquery/dist/jquery.min.js') }}"></script>


    <script src="{{ asset('custom/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('custom/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('custom/assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <script src="{{ asset('custom/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/datatables.net-bs5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/datatables.net-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('custom/assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/parsleyjs/parsley.min.js') }}"></script>

    <script src="{{ asset('custom/assets/extensions/blockUI/blockUI.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/select2/select2.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/momentjs/moment.min.js') }}"></script>

    <script src="{{ asset('custom/assets/helper/helper.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Mencari submenu yang aktif
            var activeSubmenu = $('.submenu .submenu-item.active').parent();
            // Menambahkan kelas active ke parent <li>
            activeSubmenu.addClass('active submenu-open');
            activeSubmenu.parent().addClass('active');
        });
    </script>
    @stack('after-script')
</body>

</html>
