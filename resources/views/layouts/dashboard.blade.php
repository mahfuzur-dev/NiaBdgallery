<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Moon Light School Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

        <!-- C3 charts css -->
        <link href="{{asset('backend/plugins/c3/c3.min.css')}}" rel="stylesheet" type="text/css"  />

        <!-- App css -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css" />

        <script src="{{asset('backend/assets/js/modernizr.min.js')}}"></script>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                                <span>
                                    <img src="{{asset('backend/assets/images/logo.png')}}" alt="" height="25">
                                </span>
                        <i>
                            <img src="{{asset('backend/assets/images/logo_sm.png')}}" alt="" height="28">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                    <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                               @if (Auth::user()->profile_photo == null)
                                   <img src="{{ Avatar::create('Joko Widodo')->toBase64() }}" />
                                   @else
                                   <img src="{{asset('uploads/user')}}/{{Auth::user()->profile_photo}}" alt="user" class="rounded-circle">
                               @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! John</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="{{route('user.details')}}" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="{{route('dashboard')}}">
                                    <i class="fi-air-play"></i> <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('user.list')}}">
                                    <i class="fa fa-user-circle"></i><span> Users</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="javascript: void(0);" aria-expanded="false"><i class="fa fa-align-left"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                    <li><a href="{{route('add.category')}}">Add Category</a></li>
                                    <li><a href="{{route('list.category')}}">Category List</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript: void(0);" aria-expanded="false"><i class="fa fa-align-right"></i> <span> SubCategory </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                    <li><a href="{{route('subcategory')}}">Add SubCategory</a></li>
                                    <li><a href="{{route('list.subcategory')}}">SubCategory List</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript: void(0);" aria-expanded="false"><i class="fa fa-product-hunt"></i> <span> Product </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                    <li><a href="{{route('product')}}">Add Product</a></li>
                                    <li><a href="{{route('list.product')}}">Product List</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript: void(0);" aria-expanded="false"><i class="fa fa-percent" aria-hidden="true"></i><span> Coupon </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                    <li><a href="{{route('coupon')}}">Add Coupon</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="{{route('color')}}" aria-expanded="false"><i class="fa fa-paint-brush"></i><span> Color </span></a>
                            </li>
                            <li class="">
                                <a href="{{route('orders')}}" aria-expanded="false"><i class="fa fa-first-order" aria-hidden="true"></i><span> Order </span></a>
                            </li>
                            <li class="">
                                <a href="{{route('contact.message')}}" aria-expanded="false"><i class="fa fa-comments" aria-hidden="true"></i><span> Customer Message </span></a>
                            </li>
                            <li class="">
                                <a href="{{route('size')}}" aria-expanded="false"><i class="dripicons-pill "></i><span> Size </span></a>
                            </li>
                            <li class="">
                                <a href="{{route('role')}}" aria-expanded="false"><i class="fa fa-gavel"></i><span> Role & Permissions </span></a>
                            </li>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        @yield('content')
                        <!--- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer m-auto text-center">
                    
                    <?php echo date('Y') ?> © Sun-Rice Develop By Mahfuzur Rahman
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
        <script src="{{asset('backend/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/waves.js')}}"></script>
        <script src="{{asset('backend/assets/js/jquery.slimscroll.js')}}"></script>

        <!-- Counter js  -->
        <script src="{{asset('backend/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('backend/plugins/counterup/jquery.counterup.min.js')}}"></script>

        <!--C3 Chart-->
        <script type="text/javascript" src="{{asset('backend/plugins/d3/d3.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('backend/plugins/c3/c3.min.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <!--Echart Chart-->
        <script src="{{asset('backend/plugins/echart/echarts-all.js')}}"></script>

        <!-- Dashboard init -->
        <script src="{{asset('backend/assets/pages/jquery.dashboard.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('backend/assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('backend/assets/js/jquery.app.js')}}"></script>
        @yield('footer_script')

    </body>
</html>