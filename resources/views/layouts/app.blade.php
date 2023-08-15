<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Warehouse BUT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{config('app.name')}}" name="description" />
        <meta content="{{config('app.name')}}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('template/assets') }}/images/favicon.ico">

        <!-- plugins -->
        <link href="{{ asset('template/assets') }}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/assets') }}/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/assets') }}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
		<link href="{{ asset('template/assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('template/assets') }}/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{ asset('template/assets') }}/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="{{ asset('template/assets') }}/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="{{ asset('template/assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>

    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-end mb-0">


                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="fullscreen" href="#">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>



                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name={{auth()->user()->name}}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    {{ auth()->user()->name }} <i class="uil uil-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <a href="javascript:;" onclick="logout()" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="/" class="logo logo-dark">
                            <span class="logo-sm">
                                <span class="logo-sm-text-dark">{{substr(config('app.name'),0,1)}}</span>

                            </span>
                            <span class="logo-lg">
                                <div class="logo-lg-text-dark" style="
                                background-image: url('/template/logo_but.png');
                                height: 65px;
                                width: 100%;
                        
                                background-size: cover;"></div>                           
                                 </span>
                        </a>

                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile">
                                <i data-feather="menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li>
                                <a href="{{route('home')}}">
                                    <i data-feather="home"></i>
                                    <span> Halaman Utama </span>
                                </a>
                            </li>

                            @if(auth()->user()->role == 'admin')

                            <li class="menu-title mt-2">Master Data</li>
                                <li class="{{request()->routeIs('users.*') ? 'menuitem-active' : ''}}">
                                    <a href="{{route('users.index')}}">
                                        <i data-feather="users"></i>
                                        <span> Data Pengguna </span>
                                    </a>
                                </li>

                                <li class="{{request()->routeIs('items.*') ? 'menuitem-active' : ''}}">
                                    <a href="{{route('items.index')}}">
                                        <i data-feather="box"></i>
                                        <span> Data Barang </span>
                                    </a>
                                </li>
                            @endif



                            <li class="menu-title mt-2">Transaksi Data</li>

                            @php
                            $array_trx_mutation = [
                                [
                                    'label' => 'Masuk',
                                    'route' => 'in'
                                ],
                                [
                                    'label' => 'Keluar',
                                    'route' => 'out'
                                ]
                            ]
                            @endphp

                            <li class="{{request()->routeIs('item-mutations.type.*') ? 'menuitem-active' : ''}}">
                                <a href="#mutation-menu"  data-bs-toggle="collapse">
                                    <i data-feather="activity"></i>
                                    <span> Mutasi Barang </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="mutation-menu">
                                    <ul class="nav-second-level">
                                        @forelse ($array_trx_mutation as $key => $item)
                                            <li><a href="{{route('item-mutations.type',strtolower($item['route']))}}">Barang {{$item['label']}}</a></li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </div>
                            </li>

                                <li class="menu-title mt-2">Informasi Data</li>
                                <li class="{{request()->routeIs('information.*') ? 'menuitem-active' : ''}}">
                                    <a href="#info-menu"  data-bs-toggle="collapse">
                                        <i data-feather="package"></i>
                                        <span> Gudang </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="info-menu">
                                        <ul class="nav-second-level">
                                            @forelse (warehouse() as $key => $item)
                                                <li><a href="{{route('information',$key)}}">{{$item['label']}}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-title mt-2">Laporan</li>
                                @php
                                $array_report_mutation = [
                                    [
                                        'label' => 'Masuk',
                                        'route' => 'in'
                                    ],
                                    [
                                        'label' => 'Keluar',
                                        'route' => 'out'
                                    ]
                                ]
                                @endphp
                                <li class="{{request()->routeIs('report.*') ? 'menuitem-active' : ''}}">
                                    <a href="#report-menu"  data-bs-toggle="collapse">
                                        <i data-feather="activity"></i>
                                        <span> Barang </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="report-menu">
                                        <ul class="nav-second-level">
                                            @forelse ($array_report_mutation as $key => $item)
                                                <li><a href="{{route('report',strtolower($item['route']))}}">Barang {{$item['label']}}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                </li>




                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title"></h4>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        @yield('content')

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="text-center">
                            <div class="col-md-12">
                                <script>document.write(new Date().getFullYear())</script> &copy; {{config('app.name')}}
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        <script src="{{ asset('template/assets') }}/js/vendor.min.js"></script>

        <!-- optional plugins -->
        <script src="{{ asset('template/assets') }}/libs/moment/min/moment.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/flatpickr/flatpickr.min.js"></script>

        <script src="{{ asset('template/assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="{{ asset('template/assets') }}/libs/datatables.net-select/js/dataTables.select.min.js"></script>

        <script>
            $('.range-datepicker').flatpickr({
                mode: "range"
            });
            $("#table").DataTable({
                responsive:true
            })

            $(".table-json").DataTable({
                responsive:true
            })
        </script>
        <!-- App js -->
        <script src="{{ asset('template/assets') }}/js/app.min.js"></script>
        @include('includes.plugin')
        @yield('js')


    </body>

</html>
