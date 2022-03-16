<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-Lapor -- @yield('title')</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> /
    <!-- limonte-sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('style')
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ url('/') }}">E-LAPOR</a>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <p class="text-light my-2">
            <?php
            use Carbon\Carbon;
            $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
            echo $today;
            ?>
        </p>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            {{-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div> --}}
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    {{-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li> --}}
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf

                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                        @if (auth()->user()->is_admin == 1)
                            <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                                href="{{ route('admin.home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                        @elseif(auth()->user()->is_admin == 2)
                            <a class="nav-link {{ request()->routeIs('spv.*') ? 'active' : '' }}"
                                href="{{ route('spv.home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                        @else
                            <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
                                href="{{ route('user.home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                        @endif
                        {{-- <div class="sb-sidenav-menu-heading">Interface</div> --}}
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Input Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#">Input data Outlet</a>
                                <a class="nav-link" href="#">Input data Mesin</a>
                                <a class="nav-link" href="#">Input data Mesin</a>
                                <a class="nav-link" href="#">Input data Mesin</a>
                            </nav>
                        </div> --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                @if (auth()->user()->is_admin == 1)
                                    <a class="nav-link {{ request()->routeIs('outlet.*') ? 'active' : '' }}"
                                        href="{{ route('outlet.indexAdmin') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                                        </div>
                                        Outlets
                                    </a>
                                @elseif(auth()->user()->is_admin == 2)
                                    <a class="nav-link" href="#">
                                        <div class="sb-nav-link-icon">
                                            <i class="fas fa-fw fa-store"></i>
                                        </div>
                                        Outlet
                                    </a>
                                @else
                                    <a class="nav-link" href="#">
                                        <div class="sb-nav-link-icon">
                                            <i class="fas fa-fw fa-store"></i>
                                        </div>
                                        Outlet
                                    </a>
                                @endif
                                {{-- <a class="nav-link" href="#">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-fw fa-store"></i>
                                    </div>
                                    Outlet
                                </a> --}}
                                @if (auth()->user()->is_admin == 1)
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                        href="{{ route('users.index') }}">
                                        <div class="sb-nav-link-icon">
                                            <i class="fas fa-fw fa-user"></i>
                                        </div>
                                        Kontrol Akun
                                    </a>
                                @else
                                @endif
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-fw fa-store"></i>
                                    </div>
                                    Mesin
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        @if (auth()->user()->is_admin == 1)
                                            <a class="nav-link" href="{{ route('mesins.indexAdmin') }}">
                                                <div class="sb-nav-link-icon">
                                                    <i class="fa fa-fw fa-plus"></i>
                                                </div>
                                                Data Mesin
                                            </a>

                                            <a class="nav-link" href="{{ route('perbaikan.indexAdmin') }}">
                                                <div class="sb-nav-link-icon">
                                                    <i class="fa fa-fw fa-plus"></i>
                                                </div>
                                                Data Perbaikan
                                            </a>
                                        @else
                                        @endif
                                        <a class="nav-link" href="{{ route('kerusakans.indexAdmin') }}">
                                            <div class="sb-nav-link-icon">
                                                <i class="fa fa-fw fa-plus"></i>
                                            </div>
                                            Data Kerusakan
                                        </a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @if (session()->has('error'))
                    <script>
                        Swal.fire(
                            'Maaf',
                            'Anda tidak punya akses kehalaman ini',
                            'error'
                        )
                    </script>
                @endif
                @yield('content')
            </main>
            {{-- <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

</body>

</html>
