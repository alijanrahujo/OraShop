@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">

                <!-- sample modal content -->
                <div class="button-box">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" data-whatever="@mdo">Sale Now</button>
                </div>
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="createModalLabel1">Add Accessory</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{Route('accessory.store')}}" method="POST" enctype="multipart/form-data" accept="image/*">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="accessory_id" class="control-label">Select Item:</label>
                                    <select name="accessory_id" id="accessory_id" class="form-control">
                                        <option value="">Select Item</option>
                                        @foreach ($accessories as $accessory)
                                            <option value="{{ $accessory->id }}">{{ $accessory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class="control-label">Qty:</label>
                                    <input type="number" name="qty" class="form-control" id="qty">
                                </div>
                                <div class="form-group">
                                    <label for="selling_price" class="control-label">Purchase Price:</label>
                                    <input type="number" name="selling_price" class="form-control" id="selling_price">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Accessories</h4>
                        <h6 class="card-subtitle">Accessories List</h6>
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Purchase Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accessories as $accessory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/' . $accessory->image) }}" width="60"></td>
                                        <td>{{ $accessory->title }}</td>
                                        <td>{{ $accessory->description }}</td>
                                        <td>{{ $accessory->purchase_price }}</td>
                                        <td>{{ $accessory->quantity }}</td>
                                        <td>{{ ($accessory->status)?'Actice':'Deactive' }}</td>
                                        <td>
                                            <a href="{{ route('accessory.edit', $accessory->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('accessory.destroy', $accessory->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                @foreach ($accessories as $accessory)
                                <div class="col-6 col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top"
                                            src="{{ asset('storage/' . $accessory->image) }}"
                                            alt="{{$accessory->title}}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$accessory->title}}</h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
