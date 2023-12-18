<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<title>@yield('title') - Sistema Contable | Hyperonym</title>
        <!-- Favicon -->
        <link rel="icon" href="{{asset('assets/images/logos/logo.png')}}" type="image/png">
        <!-- Icons -->
        <link rel="stylesheet" href="{{ url('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
        <!-- Bootstrap Css -->
        <link href="{{ url('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        @stack('style')
        <!-- App Css-->
        <link href="{{ url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <style>
            body[data-sidebar=dark] .mm-active .active{
                color: #ffffff!important;
                background: #556ee6!important;
            }
            input[readonly]{
                background-color:#eeebeb !important;
            }
        </style>
</head>

<body data-topbar="dark" data-layout="horizontal" data-layout-size="boxed">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner-chase">
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                </div>
            </div>
        </div>
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ route('inicio') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logos/logo.png')}}" alt="" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logos/logo-light.png')}}" alt="" height="50">
                                </span>
                            </a>

                            <a href="{{ route('inicio') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logos/logo-light.png')}}" alt="" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logos/logo-light.png')}}" alt="" height="50">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{url('assets/images/users/avatar-1.jpg')}}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth::user()->name}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item text-danger"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  </a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>
            <div class="topnav">
                <div class="container-fluid">
                    @include('partials.nav')
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Hyperonym.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Diseñado & Desarollado por Hyperonym
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
            
        </div>
</div>
    <!-- JAVASCRIPT -->
    <script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>
    @stack('script')
    <!-- App js -->
    <script src="{{url('assets/js/app.js')}}"></script>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    @include('sweetalert::alert')
</body>
</html>