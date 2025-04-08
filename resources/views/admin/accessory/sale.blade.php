@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <div>
                                <h4 class="card-title">Cart</h4>
                            </div>
                            <div class="ml-auto">
                                <a href="{{Route('dashboard')}}" class="btn btn-primary">Go Back</a>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Sale Price</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <div>
                                <h4 class="card-title">Accessories Saling</h4>
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="row">
                                <!-- Product 1 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://appleman.pk/cdn/shop/files/1718186226_gltnoigqa.jpg?v=1724832329"
                                            alt="Product 1">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 1</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 2 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6dOMUxTRESB76ZHdqyjUYeEgcgmzz59grjQ&s"
                                            alt="Product 2">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 2</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 3 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://i0.wp.com/huaweistore.com.pk/wp-content/uploads/2024/09/Huawei-USB-C-Power-Adapter-65W-UK-plug.jpg?fit=600%2C600&ssl=1"
                                            alt="Product 3">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 3</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 4 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://breachit.pk/cdn/shop/files/t119-girl-art-transparent-design-mobile-case-735439.jpg?v=1743208403"
                                            alt="Product 4">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 4</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 1 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://appleman.pk/cdn/shop/files/1718186226_gltnoigqa.jpg?v=1724832329"
                                            alt="Product 1">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 1</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 2 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6dOMUxTRESB76ZHdqyjUYeEgcgmzz59grjQ&s"
                                            alt="Product 2">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 2</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 3 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://i0.wp.com/huaweistore.com.pk/wp-content/uploads/2024/09/Huawei-USB-C-Power-Adapter-65W-UK-plug.jpg?fit=600%2C600&ssl=1"
                                            alt="Product 3">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 3</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 4 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://breachit.pk/cdn/shop/files/t119-girl-art-transparent-design-mobile-case-735439.jpg?v=1743208403"
                                            alt="Product 4">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 4</h5>
                                        </div>
                                    </div>
                                </div>


                                <!-- Product 1 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://appleman.pk/cdn/shop/files/1718186226_gltnoigqa.jpg?v=1724832329"
                                            alt="Product 1">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 1</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 2 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6dOMUxTRESB76ZHdqyjUYeEgcgmzz59grjQ&s"
                                            alt="Product 2">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 2</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 3 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://i0.wp.com/huaweistore.com.pk/wp-content/uploads/2024/09/Huawei-USB-C-Power-Adapter-65W-UK-plug.jpg?fit=600%2C600&ssl=1"
                                            alt="Product 3">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 3</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 4 -->
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="https://breachit.pk/cdn/shop/files/t119-girl-art-transparent-design-mobile-case-735439.jpg?v=1743208403"
                                            alt="Product 4">
                                        <div class="card-body">
                                            <h5 class="card-title">Product 4</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">Yearly Earning</h4>
                        </div>
                        <div class="ml-auto">
                            <ul class="list-inline">
                                <li>
                                    <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>iMac</h6> </li>
                                <li>
                                    <h6 class="text-muted  text-info"><i class="fa fa-circle font-10 m-r-10"></i>iPhone</h6> </li>

                            </ul>
                        </div>
                    </div>
                    <div id="morris-area-chart2" style="height: 405px;"></div>

                </div>
            </div>
            <div class="card card-default">
                        <div class="card-header">
                            <div class="card-actions">
                                <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                            </div>
                            <h4 class="card-title m-b-0">Product Overview</h4>
                        </div>
                        <div class="card-body collapse show">
                            <div class="table-responsive">
                                <table class="table product-overview">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Photo</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Steave Jobs</td>
                                            <td>
                                                <img src="{{ asset('admin/assets/images/gallery/chair.jpg') }}" alt="iMac" width="80">
                                            </td>
                                            <td>20</td>
                                            <td>10-7-2017</td>
                                            <td>
                                                <span class="label label-success font-weight-100">Paid</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Varun Dhavan</td>
                                            <td>
                                                <img src="{{ asset('admin/assets/images/gallery/chair2.jpg') }}" alt="iPhone" width="80">
                                            </td>
                                            <td>25</td>
                                            <td>09-7-2017</td>
                                            <td>
                                                <span class="label label-warning font-weight-100">Pending</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Ritesh Desh</td>
                                            <td>
                                                <img src="{{ asset('admin/assets/images/gallery/chair3.jpg') }}" alt="apple_watch" width="80">
                                            </td>
                                            <td>12</td>
                                            <td>08-7-2017</td>
                                            <td>
                                                <span class="label label-success font-weight-100">Paid</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Hrithik</td>
                                            <td>
                                                <img src="{{ asset('admin/assets/images/gallery/chair4.jpg') }}" alt="mac_mouse" width="80">
                                            </td>
                                            <td>18</td>
                                            <td>02-7-2017</td>
                                            <td>
                                                <span class="label label-danger font-weight-100">Failed</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="col-lg-4 col-md-5">
            <!-- Column -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                    <h4 class="card-title m-b-0">Order Stats</h4>
                </div>
                <div class="card-body collapse show">
                <div id="morris-donut-chart" class="ecomm-donute" style="height: 317px;"></div>
                    <ul class="list-inline m-t-20 text-center">
                    <li >
                        <h6 class="text-muted"><i class="fa fa-circle text-info"></i> Order</h65>
                        <h4 class="m-b-0">8500</h4>
                    </li>
                    <li>
                        <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> Pending</h6>
                        <h4 class="m-b-0">3630</h4>
                    </li>
                    <li>
                        <h6 class="text-muted"> <i class="fa fa-circle text-success"></i> Delivered</h6>
                        <h4 class="m-b-0">4870</h4>
                    </li>
                </ul>

                </div>
            </div>
            <!-- Column -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                    <h4 class="card-title m-b-0">Offer for you</h4>
                </div>
                <div class="card-body collapse show bg-info">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item flex-column">
                                <i class="fa fa-shopping-cart fa-2x text-white"></i>
                                <p class="text-white">25th Jan</p>
                                <h3 class="text-white font-light">Now Get <span class="font-bold">50% Off</span><br>
                          on buy</h3>
                                <div class="text-white m-t-20">
                                    <i>- Ecommerce site</i>
                                </div>
                            </div>
                            <div class="carousel-item flex-column">
                                <i class="fa fa-shopping-cart fa-2x text-white"></i>
                                <p class="text-white">25th Jan</p>
                                <h3 class="text-white font-light">Now Get <span class="font-bold">50% Off</span><br>
                          on buy</h3>
                                <div class="text-white m-t-20">
                                    <i>- Ecommerce site</i>
                                </div>
                            </div>
                            <div class="carousel-item flex-column active">
                                <i class="fa fa-shopping-cart fa-2x text-white"></i>
                                <p class="text-white">25th Jan</p>
                                <h3 class="text-white font-light">Now Get <span class="font-bold">50% Off</span><br>
                          on buy</h3>
                                <div class="text-white m-t-20">
                                    <i>- Ecommerce site</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                    <h4 class="card-title m-b-0">Latest Products</h4>
                </div>
                <div class="card-body p-0 collapse show text-center">
                    <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item flex-column">
                                <img src="{{ asset('admin/assets/images/gallery/chair.jpg') }}" alt="user">
                                <h4 class="m-b-30">Brand New Chair</h4>
                            </div>
                            <div class="carousel-item flex-column">
                                <img src="{{ asset('admin/assets/images/gallery/chair2.jpg') }}" alt="user">
                                <h4 class="m-b-30">Brand New Chair</h4>
                            </div>
                            <div class="carousel-item flex-column active carousel-item-left">
                                <img src="{{ asset('admin/assets/images/gallery/chair3.jpg') }}" alt="user">
                                <h4 class="m-b-30">Brand New Chair</h4>
                            </div>
                            <div class="carousel-item flex-column carousel-item-next carousel-item-left">
                                <img src="{{ asset('admin/assets/images/gallery/chair4.jpg') }}" alt="user">
                                <h4 class="m-b-30">Brand New Chair</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <!-- Row -->


        <!-- Row -->

        <!-- Row -->
        <!-- Row -->

        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="m-t-20 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/1.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Varun Dhavan <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/2.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small
                                        class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/3.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small
                                        class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/4.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Arijit Sinh <small
                                        class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/5.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Govinda Star <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/6.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>John Abraham<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/7.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Hritik Roshan<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/8.jpg') }}"
                                    alt="user-img" class="img-circle"> <span>Pwandeep rajan <small
                                        class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
