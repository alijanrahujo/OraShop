<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

        <link href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/plugins/lightpick/lightpick.css') }}" rel="stylesheet" />

        <!-- App css -->
        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert -->
        <link href="{{ asset('admin/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
        @livewireStyles
    </head>

    <body>

         <!-- Top Bar Start -->
         <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="/" class="logo">
                    <span>
                        <img src="{{ asset('admin/assets/images/orasoft logo.jpg') }}" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="{{ asset('admin/assets/images/orasoft logo.jpg') }}" alt="logo-large" class="logo-lg logo-light">
                        {{-- <img src="{{ asset('admin/assets/images/orasoft logo.jpg') }}" alt="logo-large" class="logo-lg"> --}}
                    </span>
                </a>
            </div>
            <!--end logo-->
            <!-- Navbar -->
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-nav float-right mb-0">
                    <x-change-shop />
                    <li class="hidden-sm">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript: void(0);" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            English <img src="{{ asset('admin/assets/images/flags/us_flag.jpg') }}" class="ml-2" height="16" alt=""/> <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript: void(0);"><span> German </span><img src="{{ asset('admin/assets/images/flags/germany_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> Italian </span><img src="{{ asset('admin/assets/images/flags/italy_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> French </span><img src="{{ asset('admin/assets/images/flags/french_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> Spanish </span><img src="{{ asset('admin/assets/images/flags/spain_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
                            <a class="dropdown-item" href="javascript: void(0);"><span> Russian </span><img src="{{ asset('admin/assets/images/flags/russia_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="ti-bell noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">

                            <h6 class="dropdown-item-text font-15 m-0 py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                                Notifications <span class="badge badge-light badge-pill">2</span>
                            </h6>
                            <div class="slimscroll notification-list">
                                <!-- item-->
                                <a href="#" class="dropdown-item py-3">
                                    <small class="float-right text-muted pl-2">2 min ago</small>
                                    <div class="media">
                                        <div class="avatar-md bg-primary">
                                           <i class="la la-cart-arrow-down text-white"></i>
                                        </div>
                                        <div class="media-body align-self-center ml-2 text-truncate">
                                            <h6 class="my-0 font-weight-normal text-dark">Your order is placed</h6>
                                            <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </a><!--end-item-->
                                <!-- item-->
                                <a href="#" class="dropdown-item py-3">
                                    <small class="float-right text-muted pl-2">10 min ago</small>
                                    <div class="media">
                                        <div class="avatar-md bg-success">
                                            <i class="la la-group text-white"></i>
                                        </div>
                                        <div class="media-body align-self-center ml-2 text-truncate">
                                            <h6 class="my-0 font-weight-normal text-dark">Meeting with designers</h6>
                                            <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </a><!--end-item-->
                                <!-- item-->
                                <a href="#" class="dropdown-item py-3">
                                    <small class="float-right text-muted pl-2">40 min ago</small>
                                    <div class="media">
                                        <div class="avatar-md bg-pink">
                                            <i class="la la-list-alt text-white"></i>
                                        </div>
                                        <div class="media-body align-self-center ml-2 text-truncate">
                                            <h6 class="my-0 font-weight-normal text-dark">UX 3 Task complete.</h6>
                                            <small class="text-muted mb-0">Dummy text of the printing.</small>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </a><!--end-item-->
                                <!-- item-->
                                <a href="#" class="dropdown-item py-3">
                                    <small class="float-right text-muted pl-2">1 hr ago</small>
                                    <div class="media">
                                        <div class="avatar-md bg-warning">
                                            <i class="la la-truck text-white"></i>
                                        </div>
                                        <div class="media-body align-self-center ml-2 text-truncate">
                                            <h6 class="my-0 font-weight-normal text-dark">Your order is placed</h6>
                                            <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </a><!--end-item-->
                                <!-- item-->
                                <a href="#" class="dropdown-item py-3">
                                    <small class="float-right text-muted pl-2">2 hrs ago</small>
                                    <div class="media">
                                        <div class="avatar-md bg-info">
                                            <i class="la la-check-circle text-white"></i>
                                        </div>
                                        <div class="media-body align-self-center ml-2 text-truncate">
                                            <h6 class="my-0 font-weight-normal text-dark">Payment Successfull</h6>
                                            <small class="text-muted mb-0">Dummy text of the printing.</small>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </a><!--end-item-->
                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('admin/assets/images/users/user-1.png') }}" alt="profile-user" class="rounded-circle" />
                            <span class="ml-1 nav-user-name hidden-sm">{{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="ti-wallet text-muted mr-2"></i> My Wallet</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="ti-lock text-muted mr-2"></i> Lock screen</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off text-muted mr-2"></i> Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->

                <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="nav-link button-menu-mobile waves-effect waves-light">
                            <i class="ti-menu nav-icon"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" id="AllCompo" placeholder="Search..." class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <ul class="metismenu left-sidenav-menu">
                <li class="{{ Request::routeIs('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ Route('dashboard') }}"><i class="ti-bar-chart"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                </li>

                <li class="{{ Request::routeIs('account.*') ? 'mm-active' : '' }}">
                    <a href="{{ Route('account.index') }}"><i class="ti-layers-alt"></i><span>Accounts</span><span class="menu-arrow"></span></a>
                </li>

                <li class="{{ Request::routeIs('accessory.*','category.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);"><i class="ti-lock"></i><span>Accessories</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="{{ Route('category.index') }}"><i class="ti-control-record"></i>Category</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ Route('accessory.index') }}"><i class="ti-control-record"></i>Product</a></li>
                    </ul>
                </li>

                <li class="{{ Request::routeIs('purchase.*') ? 'mm-active' : '' }}">
                    <a href="{{ Route('purchase.index') }}"><i class="ti-wallet"></i><span>Purchase Accessory</span><span class="menu-arrow"></span></a>
                </li>

                <li class="{{ Request::routeIs('sale.*') ? 'mm-active' : '' }}">
                    <a href="{{ Route('sale.index') }}"><i class="ti-wallet"></i><span>Sale Accessory</span><span class="menu-arrow"></span></a>
                </li>

                <li class="{{ Request::routeIs('load.*') ? 'mm-active' : '' }}">
                    <a href="{{ Route('load.index') }}"><i class="ti-package"></i><span>Load</span><span class="menu-arrow"></span></a>
                </li>

                <li class="{{ Request::routeIs('pos.*') ? 'mm-active' : '' }}">
                    <a href="{{ Route('pos.index') }}"><i class="ti-package"></i><span>POS</span><span class="menu-arrow"></span></a>
                </li>

                <li class="{{ Request::routeIs('report.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);"><i class="ti-lock"></i><span>Reports</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="{{ Route('report.sale') }}"><i class="ti-control-record"></i>Sale Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ Route('report.account') }}"><i class="ti-control-record"></i>Account Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ Route('report.load') }}"><i class="ti-control-record"></i>Load Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ Route('report.purchase') }}"><i class="ti-control-record"></i>Purchase Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ Route('report.balance') }}"><i class="ti-control-record"></i>Balance Report</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);"><i class="ti-server"></i><span>Apps</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Email <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../apps/email-inbox.html">Inbox</a></li>
                                <li><a href="../apps/email-read.html">Read Email</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../apps/chat.html"><i class="ti-control-record"></i>Chat</a></li>
                        <li class="nav-item"><a class="nav-link" href="../apps/contact-list.html"><i class="ti-control-record"></i>Contact List</a></li>
                        <li class="nav-item"><a class="nav-link" href="../apps/calendar.html"><i class="ti-control-record"></i>Calendar</a></li>
                        <li class="nav-item"><a class="nav-link" href="../apps/invoice.html"><i class="ti-control-record"></i>Invoice</a></li>
                        <li class="nav-item"><a class="nav-link" href="../apps/tasks.html"><i class="ti-control-record"></i>Tasks</a></li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Projects <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../apps/project-overview.html">Overview</a></li>
                                <li><a href="../apps/project-projects.html">Projects</a></li>
                                <li><a href="../apps/project-board.html">Board</a></li>
                                <li><a href="../apps/project-teams.html">Teams</a></li>
                                <li><a href="../apps/project-files.html">Files</a></li>
                                <li><a href="../apps/new-project.html">New Project</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Ecommerce <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../apps/ecommerce-products.html">Products</a></li>
                                <li><a href="../apps/ecommerce-product-list.html">Product List</a></li>
                                <li><a href="../apps/ecommerce-product-detail.html">Product Detail</a></li>
                                <li><a href="../apps/ecommerce-cart.html">Cart</a></li>
                                <li><a href="../apps/ecommerce-checkout.html">Checkout</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="ti-crown"></i><span>UI Kit</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Elements <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/ui-bootstrap.html">Bootstrap</a></li>
                                <li><a href="../others/ui-animation.html">Animation</a></li>
                                <li><a href="../others/ui-avatar.html">Avatar</a></li>
                                <li><a href="../others/ui-clipboard.html">Clip Board</a></li>
                                <li><a href="../others/ui-files.html">File Manager</a></li>
                                <li><a href="../others/ui-check-radio.html"><span>Check & Radio</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Advanced UI <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/advanced-rangeslider.html">Range Slider</a></li>
                                <li><a href="../others/advanced-sweetalerts.html">Sweet Alerts</a></li>
                                <li><a href="../others/advanced-nestable.html">Nestable List</a></li>
                                <li><a href="../others/advanced-ratings.html">Ratings</a></li>
                                <li><a href="../others/advanced-highlight.html">Highlight</a></li>
                                <li><a href="../others/advanced-session.html">Session Timeout</a></li>
                                <li><a href="../others/advanced-idle-timer.html">Idle Timer</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Forms <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/forms-elements.html">Basic Elements</a></li>
                                <li><a href="../others/forms-advanced.html">Advance Elements</a></li>
                                <li><a href="../others/forms-validation.html">Validation</a></li>
                                <li><a href="../others/forms-wizard.html">Wizard</a></li>
                                <li><a href="../others/forms-editors.html">Editors</a></li>
                                <li><a href="../others/forms-repeater.html">Repeater</a></li>
                                <li><a href="../others/forms-x-editable.html">X Editable</a></li>
                                <li><a href="../others/forms-uploads.html">File Upload</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Charts <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/charts-apex.html">Apex</a></li>
                                <li><a href="../others/charts-morris.html">Morris</a></li>
                                <li><a href="../others/charts-flot.html">Flot</a></li>
                                <li><a href="../others/charts-chartjs.html">Chartjs</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Tables <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/tables-basic.html">Basic</a></li>
                                <li><a href="../others/tables-datatable.html">Datatables</a></li>
                                <li><a href="../others/tables-responsive.html">Responsive</a></li>
                                <li><a href="../others/tables-editable.html">Editable</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Icons <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/icons-materialdesign.html">Material Design</a></li>
                                <li><a href="../others/icons-dripicons.html">Dripicons</a></li>
                                <li><a href="../others/icons-fontawesome.html">Font awesome</a></li>
                                <li><a href="../others/icons-themify.html">Themify</a></li>
                                <li><a href="../others/icons-typicons.html">Typicons</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Maps <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/maps-google.html">Google Maps</a></li>
                                <li><a href="../others/maps-vector.html">Vector Maps</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);"><i class="ti-control-record"></i>Email Template <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="../others/email-templates-basic.html">Basic Action Email</a></li>
                                <li><a href="../others/email-templates-alert.html">Alert Email</a></li>
                                <li><a href="../others/email-templates-billing.html">Billing Email</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="ti-layers-alt"></i><span>Pages</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="../pages/pages-profile.html"><i class="ti-control-record"></i>Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/pages-timeline.html"><i class="ti-control-record"></i>Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/pages-treeview.html"><i class="ti-control-record"></i>Treeview</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/pages-starter.html"><i class="ti-control-record"></i>Starter Page</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/pages-pricing.html"><i class="ti-control-record"></i>Pricing</a></li>
                        <li class="nav-item"><a class="nav-link" href="../pages/pages-gallery.html"><i class="ti-control-record"></i>Gallery</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="ti-lock"></i><span>Authentication</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="../authentication/auth-login.html"><i class="ti-control-record"></i>Log in</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/auth-register.html"><i class="ti-control-record"></i>Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/auth-recover-pw.html"><i class="ti-control-record"></i>Recover Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/auth-lock-screen.html"><i class="ti-control-record"></i>Lock Screen</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/auth-404.html"><i class="ti-control-record"></i>Error 404</a></li>
                        <li class="nav-item"><a class="nav-link" href="../authentication/auth-500.html"><i class="ti-control-record"></i>Error 500</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- end left-sidenav-->

        <div class="page-wrapper">

            <!-- Page Content-->
            <div class="page-content">

                @yield('content')

                <footer class="footer text-center text-sm-left">
                    &copy; 2025 OraShop. All Rights Reserved. <span class="text-muted d-none d-sm-inline-block float-right">Developed By OraSoft.pk</span>
                </footer><!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->




        <!-- jQuery  -->
        <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/waves.js') }}"></script>
        <script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery-ui.min.js') }}"></script>

        <script src="{{ asset('admin/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('admin/plugins/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('admin/plugins/chartjs/chart.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/chartjs/roundedBar.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/lightpick/lightpick.js') }}"></script>
        <script src="{{ asset('admin/assets/pages/jquery.sales_dashboard.init.js') }}"></script>


         <!-- Required datatable js -->
        <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/assets/pages/jquery.datatable.init.js') }}"></script>

         <!-- Sweet-Alert  -->
        <script src="{{ asset('admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('admin/assets/js/app.js') }}"></script>
        @yield('script')

        @livewireScripts

        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    confirmButtonColor: '#3085d6'
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    confirmButtonColor: '#d33'
                });
            @endif
        </script>

    </body>

</html>
