<?php

use App\Models\User;
$yoxla = User::where('id','=',Auth::id())->where('status','=',1)->count();

if($yoxla > 0){
    auth()->logout();
    return redirect()->route('daxilol')->with('error','Siz bloklandiniz');
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/x-icon" sizes="15x15" href="{{url('assets/images/database.png')}}">

    <title>ANBAR </title>
    <!-- Custom CSS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{url('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{url('dist/css/style.min.css')}}" rel="stylesheet">

   <link rel="stylesheet" type="text/css" 
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>


<body>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="{{route('hesabla')}}">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="{{url('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{url('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{url('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{url('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <!-- Notification -->
                        
                        <!-- ============================================================== -->
                        
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true">
                                <img src="{{url(Auth::user()->foto)}}" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-none d-lg-inline-block"><span>SALAM,</span> <span
                                        class="text-dark"></span>{{(Auth::user()->name)}} {{(Auth::user()->surname)}} <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="{{route('myprofile')}}"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    My Profile</a>
                                
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                                
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
    </div>


<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('hesabla')}}"
                            aria-expanded="false"><i data-feather="check" class="feather-icon"></i><span
                            class="hide-menu">STATISTIKA</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('select')}}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                        class="hide-menu">BRANDS</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('cselect')}}"
                        aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                        class="hide-menu">CLIENTS</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('pselect')}}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">PRODUCTS</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('orselect')}}"
                                aria-expanded="false"><i data-feather="check" class="feather-icon"></i><span
                                class="hide-menu">ORDERS</span></a></li>
                        @if(Auth::user()->id==1)
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('adselect')}}"
                            aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                            class="hide-menu">ADMIN</span></a></li>
                        @endif
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('isselect')}}"
                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">STAFF</span></a></li>
                        
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="ticket-list.html"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Ticket List
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-chat.html"
                                aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                    class="hide-menu">Chat</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                    class="hide-menu">Calendar</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->

       <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                
                <!-- *************************************************************** -->

        @yield('brands')
        @yield('clients')
        @yield('products')
        @yield('orders')
        @yield('profile')
        @yield('admin')
        @yield('static')
        @yield('staff')
        @yield('staffdoc')



            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
</div>



    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{url('dist/js/app-style-switcher.js')}}"></script>
    <script src="{{url('dist/js/feather.min.js')}}"></script>
    <script src="{{url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{url('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{url('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{url('assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="{{url('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{url('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{url('dist/js/pages/dashboards/dashboard1.min.js')}}"></script>



    <script>
        @if(Session::has('success'))
        toastr.options =
        {}
                toastr.success("{{ session('success') }}");
        @endif
      
        @if(Session::has('error'))
        toastr.options =
        {}
                toastr.error("{{ session('error') }}");
        @endif
      
        @if(Session::has('info'))
        toastr.options =
        {}
                toastr.info("{{ session('info') }}");
        @endif
      
        @if(Session::has('warning'))
        toastr.options =
        {}
                toastr.warning("{{ session('warning') }}");
        @endif
      </script>
</body>

</html>
        