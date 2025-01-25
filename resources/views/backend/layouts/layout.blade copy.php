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
    
    <link rel="stylesheet"
        href="{{ asset('custom/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/flatpickr/flatpickr.min.css') }}">

    @stack('after-style')
</head>

<body>
    <div id="app">

        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="{{ session('logo') }}" alt="Logo"
                                    srcset="" class="h-100" style="max-height: 75px;"></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    @include('backend.layouts.sidebar')
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">

                <div class="container row">
                    <div class="col">
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                    </div>
                    <div class="col">
                        <div class="dropdown d-flex justify-content-end">
                            <a href="#" id="topbarUserDropdown"
                                class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar avatar-md2">
                                    {{-- <div class="badge rounded-circle bg-light-info fs-4"> --}}
                                        {{-- {{ substr(auth()->user()->name,1,1) }} --}}
                                        <img src="{{ auth()->user()->avatar }}" class="img img-thumbnail" alt="">
                                    {{-- </div> --}}
                                </div>
                                <div class="text">
                                    <h6 class="user-dropdown-name">{{ Auth::user()->name }}</h6>
                                    <p class="user-dropdown-status text-sm text-muted">{{ Auth::user()->role }}</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                aria-labelledby="topbarUserDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </header>

            @yield('content')


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="text-center">
                        <p>{!! date('Y') . " &copy; " . env('APP_NAME') !!} </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @stack('before-script')
    <script src="{{ asset('custom/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/jquery/jquery.min.js') }}"></script>
    
    <script src="{{ asset('custom/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/datatables.net-bs5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/datatables.net-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    
    <script src="{{ asset('custom/assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>>
    <script src="{{ asset('custom/assets/extensions/parsleyjs/parsley.min.js') }}"></script>
    
    <script src="{{ asset('custom/assets/extensions/blockUI/blockUI.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/select2/select2.min.js') }}"></script>
    <script src="{{ asset('custom/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('custom/assets/helper/helper.js') }}"></script>


    <script src="{{ asset('custom/assets/compiled/js/app.js') }}"></script>
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
