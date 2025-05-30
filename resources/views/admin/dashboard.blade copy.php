@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sales</h4>
                    <div class="row">
                        <div class="col-md-3 offset-md-6">
                            <livewire:change-date />
                        </div>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="title-text mt-0">Account</h4>
                                <h3 class="font-weight-semibold mb-1">{{$tran_account->sum('total_amount')}}</h3>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success"><i
                                            class="mdi mdi-trending-up"></i>8.5%</span>Up From Yesterday</p>
                            </div><!--end col-->
                            <div class="col-4 text-center align-self-center">
                                <!-- <span class="card-eco-icon">👳🏻</span> -->
                                <i class="dripicons-user-group card-eco-icon  align-self-center"></i>
                            </div> <!--end col-->
                        </div> <!--end row-->
                        <div class="bg-pattern"></div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="title-text mt-0">New Orders</h4>
                                <h3 class="font-weight-semibold mb-1">10k</h3>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success"><i
                                            class="mdi mdi-trending-up"></i>1.5%</span> Up From Last Week</p>
                            </div><!--end col-->
                            <div class="col-4 text-center align-self-center">
                                <!-- <span class="card-eco-icon">🛒</span> -->
                                <i class="dripicons-cart card-eco-icon  align-self-center"></i>
                            </div> <!--end col-->
                        </div> <!--end row-->
                        <div class="bg-pattern"></div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="title-text mt-0">Return Orders</h4>
                                <h3 class="font-weight-semibold mb-1">8400</h3>
                                <p class="mb-0 text-muted text-truncate"><span class="text-danger"><i
                                            class="mdi mdi-trending-down"></i>3%</span> Down From Last Month</p>
                            </div><!--end col-->
                            <div class="col-4 text-center align-self-center">
                                <!-- <span class="card-eco-icon">🎲</span> -->
                                <i class="dripicons-jewel card-eco-icon  align-self-center"></i>
                            </div> <!--end col-->
                        </div> <!--end row-->
                        <div class="bg-pattern"></div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card card-eco">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="title-text mt-0">Revenue</h4>
                                <h3 class="font-weight-semibold mb-1">$1590</h3>
                                <p class="mb-0 text-muted text-truncate"><span class="text-success"><i
                                            class="mdi mdi-trending-up"></i>10.5%</span> Up From Yesterday</p>
                            </div><!--end col-->
                            <div class="col-4 text-center align-self-center">
                                <!-- <span class="card-eco-icon">💰</span> -->
                                <i class="dripicons-wallet card-eco-icon  align-self-center"></i>
                            </div> <!--end col-->
                        </div> <!--end row-->
                        <div class="bg-pattern"></div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body order-list">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title mt-0 mb-3">Load</h4>
                            <div class="ml-auto">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#loadModal" data-whatever="@mdo">Deposit</button>
                            </div>
                        </div>

                        <form action="{{Route('close.load')}}" method="POST">
                            @csrf
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Previous Balance</th>
                                    <th>Current Balance</th>
                                    <th>Comm</th>
                                </tr>
                                @foreach ($loads as $load)
                                <input type="hidden" name="load_id[]" value="{{$load->id}}">
                                <input type="hidden" name="date" value="{{$date}}">
                                <tr>
                                    <td><label>{{$load->title}}</label></td>
                                    <td><input type="number" name="previous[]" value="{{$load->balance}}" readonly class="form-control"></td>
                                    <td><input type="number" name="amount[]" class="form-control"></td>
                                    <td><input type="number" name="commission[]" class="form-control"></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rs: <span>{{$loads->sum('balance')}}</span></td>
                                    <td>Rs: <span>40000</span></td>
                                    <td>Rs: <span>40000</span></td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body order-list">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title mt-0 mb-3">Accounts</h4>
                            <div class="ml-auto">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#accountModal" data-whatever="@mdo">Filter</button>
                            </div>
                        </div>

                        <form action="{{Route('close.account')}}" method="post">
                            @csrf
                            <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                            <table class="table">
                                <tr>
                                    <th>Date</th>
                                    <th>{{date('d-m-Y',strtotime($date))}}</th>
                                </tr>

                                @foreach ($accounts as $account)
                                <tr>
                                    <input type="hidden" name="account_id[]" value="{{$account->id}}">
                                    <td><label>{{$account->title}} ({{$account->bank_name}})</label></td>
                                    <td><input type="number" name="amount[]" class="form-control"></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Accessories</td>
                                    <td>Rs: {{$data['accessories']}}</td>
                                </tr>

                                <tr>
                                    <td>Loads</td>
                                    <td>Rs: {{$data['loads']}}</td>
                                </tr>

                                <tr>
                                    <td>Accounts</td>
                                    <td>Rs: {{$data['account']}}</td>
                                </tr>
                                <tr>
                                    <td>Closing Balance</td>
                                    <td>Rs: {{$data['closing_balance']}}</td>
                                </tr>
                                <tr>
                                    <td>Opening Balance</td>
                                    <td>Rs: {{$data['opening_balance']}}</td>
                                </tr>
                                <tr>
                                    <td>Profit</td>
                                    <td>Rs: {{$data['closing_balance'] - $data['opening_balance'] }}</td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-right pb-0">
                        <button type="button" class="btn btn-sm btn-gradient-primary float-right"
                            onclick="update()">Update<i class="dripicons-clockwise ml-2"></i></button>
                    </div> <!--end card-body-->
                    <div class="card-body pt-0">
                        <div class="d-flex mb-0 h-100 dash-info-box">
                            <div class="w-100">
                                <div class="apexchart-wrapper">
                                    <div id="sales-radar" class="chart-gutters"></div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                    <div class="card-body bg-black">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <div class="">
                                    <h4 class="mt-0 header-title text-white">This Month Revenue</h4>
                                    <h2 class="mt-0 font-weight-semibold text-white">$57k</h2>
                                    <p class="mb-0 text-muted"><span class="text-success"><i
                                                class="mdi mdi-arrow-up"></i>14.5%</span> Up From Last Month</p>
                                </div>
                            </div><!--end col-->
                            <div class="col-4 align-self-center">
                                <div class="icon-info float-right">
                                    <i class="dripicons-wallet bg-soft-info"></i>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="float-lg-right float-none eco-revene-history justify-content-end">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">This Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Last Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Last Month</a>
                                </li>
                            </ul>
                        </div>
                        <h4 class="header-title mt-0">Revenue</h4>
                        <canvas id="bar" class="drop-shadow w-100" height="350"></canvas>
                    </div><!--end card-body-->
                </div><!--end card-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="media">
                                    <img src="{{ asset('admin/assets/images/logo-sm.png') }}" height="40"
                                        class="mr-4 align-self-center" alt="...">
                                    <div class="media-body align-self-center">
                                        <h6 class="mt-0 font-15 mb-1">Download your earnings report</h6>
                                        <p class="mb-0 text-muted font-14">There are many variations of passages
                                            of Lorem Ipsum available, Lorem Ipsum available but the majority
                                            have.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 align-self-center text-center">
                                <button class="btn btn-sm btn-warning">Download Report</button>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0">Top Global Sales</h4>
                        <div id="world-map-markers" class="dashboard-map drop-shadow-map"></div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mt-4">
                                    <span class="text-info">USA</span>
                                    <small class="float-right text-muted ml-3 font-14">81%</small>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-pink" role="progressbar"
                                            style="width: 81%; border-radius:5px;" aria-valuenow="81" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <span class="text-info">Greenland</span>
                                    <small class="float-right text-muted ml-3 font-14">68%</small>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-secondary" role="progressbar"
                                            style="width: 68%; border-radius:5px;" aria-valuenow="68" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-5 ml-auto">
                                <div class="mt-4">
                                    <span class="text-info">Australia</span>
                                    <small class="float-right text-muted ml-3 font-14">48%</small>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-purple" role="progressbar"
                                            style="width: 48%; border-radius:5px;" aria-valuenow="48" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <span class="text-info">Brazil</span>
                                    <small class="float-right text-muted ml-3 font-14">32%</small>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: 32%; border-radius:5px;" aria-valuenow="32" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body order-list">
                        <h4 class="header-title mt-0 mb-3">Order List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-top-0">Product</th>
                                        <th class="border-top-0">Pro Name</th>
                                        <th class="border-top-0">Country</th>
                                        <th class="border-top-0">Order Date/Time</th>
                                        <th class="border-top-0">Pcs.</th>
                                        <th class="border-top-0">Amount ($)</th>
                                        <th class="border-top-0">Status</th>
                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img class=""
                                                src="{{ asset('admin/assets/images/products/img-1.png') }}"
                                                alt="user">
                                        </td>
                                        <td>
                                            Beg
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/assets/images/flags/us_flag.jpg') }}" alt=""
                                                class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>3/03/2019 4:29 PM</td>
                                        <td>200</td>
                                        <td> $750</td>
                                        <td>
                                            <span class="badge badge-md badge-boxed  badge-soft-success">Shipped</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class=""
                                                src="{{ asset('admin/assets/images/products/img-2.png') }}"
                                                alt="user">
                                        </td>
                                        <td>
                                            Watch
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/assets/images/flags/french_flag.jpg') }}"
                                                alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>13/03/2019 1:09 PM</td>
                                        <td>180</td>
                                        <td> $970</td>
                                        <td>
                                            <span class="badge badge-md badge-boxed  badge-soft-danger">Delivered</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class=""
                                                src="{{ asset('admin/assets/images/products/img-3.png') }}"
                                                alt="user">
                                        </td>
                                        <td>
                                            Headphone
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/assets/images/flags/spain_flag.jpg') }}"
                                                alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>22/03/2019 12:09 PM</td>
                                        <td>30</td>
                                        <td> $2800</td>
                                        <td>
                                            <span class="badge badge-md badge-boxed badge-soft-warning">Pending</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class=""
                                                src="{{ asset('admin/assets/images/products/img-4.png') }}"
                                                alt="user">
                                        </td>
                                        <td>
                                            Purse
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/assets/images/flags/russia_flag.jpg') }}"
                                                alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>14/03/2019 8:27 PM</td>
                                        <td>100</td>
                                        <td> $520</td>
                                        <td>
                                            <span class="badge badge-md badge-boxed  badge-soft-success">Shipped</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class=""
                                                src="{{ asset('admin/assets/images/products/img-5.png') }}"
                                                alt="user">
                                        </td>
                                        <td>
                                            Shoe
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/assets/images/flags/italy_flag.jpg') }}"
                                                alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>18/03/2019 5:09 PM</td>
                                        <td>100</td>
                                        <td> $1150</td>
                                        <td>
                                            <span class="badge badge-md badge-boxed badge-soft-warning">Pending</span>
                                        </td>
                                    </tr><!--end tr-->
                                </tbody>
                            </table> <!--end table-->
                        </div><!--end /div-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            <div class="col-lg-4">

            </div><!--end col-->


        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7 align-self-center">
                                <div class="timer-data">
                                    <div class="icon-info mt-1 mb-4">
                                        <i class="mdi mdi-bullseye bg-soft-dark"></i>
                                    </div>
                                    <h3 class="mt-0 text-dark">45k <span class="font-14">of 70k</span></h3>
                                    <h4 class="mt-0 header-title text-truncate mb-1">Monthly Goal</h4>
                                    <p class="text-muted mb-0 text-truncate">It is a long established fact that a reader.
                                    </p>

                                </div>
                            </div><!--end col-->
                            <div class="col-5 align-self-center">
                                <div class="mt-4">
                                    <span class="text-info">Complate</span>
                                    <small class="float-right text-muted ml-3 font-14">62%</small>
                                    <div class="progress mt-2" style="height:5px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: 62%; border-radius:5px;" aria-valuenow="62" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->

                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-3">Populer Product</h4>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    <tr>
                                        <td class="border-top-0">
                                            <div class="media">
                                                <img src="{{ asset('admin/assets/images/products/img-7.png') }}"
                                                    height="80" class="mr-4" alt="...">
                                                <div class="media-body align-self-center">
                                                    <span class="badge badge-soft-warning p-2 font-12 mb-2">354 sold</span>
                                                    <h4 class="mt-0 title-text mb-0">Unique Watch</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right border-top-0">
                                            <h5 class="">$99.00</h5>
                                        </td>
                                    </tr><!--/tr-->
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('admin/assets/images/products/img-3.png') }}"
                                                    height="80" class="mr-4" alt="...">
                                                <div class="media-body align-self-center">
                                                    <span class="badge badge-soft-pink p-2 font-12 mb-2">654 sold</span>
                                                    <h4 class="mt-0 title-text mb-0">Wireless Headphone</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <h5 class="">$49.00</h5>
                                        </td>
                                    </tr><!--/tr-->
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img src="{{ asset('admin/assets/images/products/img-1.png') }}"
                                                    height="80" class="mr-4" alt="...">
                                                <div class="media-body align-self-center">
                                                    <span class="badge badge-soft-success p-2 font-12 mb-2">551 sold</span>
                                                    <h4 class="mt-0 title-text mb-0">Sport Shoe</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <h5 class="">$59.00</h5>
                                        </td>
                                    </tr><!--/tr-->
                                </tbody>
                            </table>
                            <a href="#" class="text-right d-block">View All<i
                                    class="dripicons-arrow-thin-right ml-2"></i></a>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7 align-self-center">
                                <div class="timer-data">
                                    <div class="icon-info mt-1 mb-4">
                                        <i class="mdi mdi-bullseye-arrow bg-soft-dark"></i>
                                    </div>
                                    <h3 class="mt-0 text-dark">26m <span class="font-14">of 30m</span></h3>
                                    <h4 class="mt-0 header-title text-truncate mb-1">Yearly Goal</h4>
                                    <p class="text-muted mb-0 text-truncate">It is a long established fact that a reader.
                                    </p>
                                </div>
                            </div><!--end col-->
                            <div class="col-5 align-self-center">
                                <div class="mt-4">
                                    <span class="text-info">Complate</span>
                                    <small class="float-right text-muted ml-3 font-14">81%</small>
                                    <div class="progress mt-2" style="height:5px;">
                                        <div class="progress-bar bg-pink" role="progressbar"
                                            style="width: 81%; border-radius:5px;" aria-valuenow="81" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
                <div class="card">
                    <div class="card-body">
                        <div class="dash-datepick">
                            <input type="hidden" id="light_datepick" />
                        </div>
                        <div class="d-flex justify-content-between p-3 bg-light">
                            <div class="media">
                                <img src="{{ asset('admin/assets/images/users/user-2.jpg') }}"
                                    class="mr-3 thumb-md rounded-circle" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="mt-0 text-dark mb-1">Harry McCall</h5>
                                    <p class="mb-0">Dealer USA <span class="text-muted">Today Harry's Birth Day</span>
                                    </p>
                                </div>
                            </div>
                            <span class="font-24 align-self-center">🎂</span>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Transaction & Balance Details</h4>
                        <div class="balence-nav">
                            <ul class="nav nav-pills justify-content-center text-center mb-3" id="pills-tab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-credit-card-tab" data-toggle="pill"
                                        href="#pills-credit-card">
                                        <img src="{{ asset('admin/assets/images/cards/card-1.png') }}" alt=""
                                            class="img-fluid">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-paypal-tab" data-toggle="pill" href="#pills-paypal">
                                        <img src="{{ asset('admin/assets/images/cards/card-2.png') }}" alt=""
                                            class="img-fluid">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-bitcoin-tab" data-toggle="pill" href="#pills-bitcoin">
                                        <img src="{{ asset('admin/assets/images/cards/card-3.png') }}" alt=""
                                            class="img-fluid">
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-credit-card">
                                    <div class="bg-light p-3 my-3">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <p class="text-muted mb-0 text-uppercase font-14">Total Balance</p>
                                                <h2>$54,922.00</h2>
                                                <span class="badge badge-soft-success font-13 p-2">+1,254.00</span>
                                            </div><!--end col-->
                                            <div class="col-xl-6 align-self-center">
                                                <div class="button-items text-right">
                                                    <button type="button"
                                                        class="btn btn-sm btn-gradient-danger waves-effect waves-light"><i
                                                            class="dripicons-arrow-thin-up mr-2"></i>Sent</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-gradient-success waves-effect waves-light"><i
                                                            class="dripicons-arrow-thin-down mr-2"></i>Receive</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div>
                                    <ul class="list-unsyled m-0 pl-0 transaction-history">
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Apple Co Pvt. Ltd</h3>
                                                        <p class="text-muted mb-0">6 June 2019 10:25 AM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$1420.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-down-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Vivo Mobile</h3>
                                                        <p class="text-muted mb-0">4 June 2019 7:05 PM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-success">$3651.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">ICICI Bank Transfer</h3>
                                                        <p class="text-muted mb-0">1 June 2019 11:30 PM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$625.22 CAN</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Sony LLP</h3>
                                                        <p class="text-muted mb-0">28 May 2019 08:45 AM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$6621.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-end">
                                            <a href="#" class="">View All<i
                                                    class="dripicons-arrow-thin-right ml-2"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end tab-pane-->
                                <div class="tab-pane fade" id="pills-paypal">
                                    <div class="bg-light p-3 my-3">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <p class="text-muted mb-0 text-uppercase font-14">Total Balance</p>
                                                <h2>$40,542.00</h2>
                                                <span class="badge badge-soft-danger font-13 p-2">-1,001.00</span>
                                            </div><!--end col-->
                                            <div class="col-xl-6 align-self-center">
                                                <div class="button-items text-right">
                                                    <button type="button"
                                                        class="btn btn-sm btn-gradient-danger waves-effect waves-light"><i
                                                            class="dripicons-arrow-thin-up mr-2"></i>Sent</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-gradient-success waves-effect waves-light"><i
                                                            class="dripicons-arrow-thin-down mr-2"></i>Receive</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div>
                                    <ul class="list-unsyled m-0 pl-0 transaction-history">
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Apple Co Pvt. Ltd</h3>
                                                        <p class="text-muted mb-0">6 June 2019 10:25 AM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$1420.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-down-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Vivo Mobile</h3>
                                                        <p class="text-muted mb-0">4 June 2019 7:05 PM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-success">$3651.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">ICICI Bank Transfer</h3>
                                                        <p class="text-muted mb-0">1 June 2019 11:30 PM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$625.22 CAN</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Sony LLP</h3>
                                                        <p class="text-muted mb-0">28 May 2019 08:45 AM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$6621.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-end">
                                            <a href="#" class="">View All<i
                                                    class="dripicons-arrow-thin-right ml-2"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end tab-pane-->
                                <div class="tab-pane fade" id="pills-bitcoin">
                                    <div class="bg-light p-3 my-3">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <p class="text-muted mb-0 text-uppercase font-14">Total Balance</p>
                                                <h2>$31,365.00</h2>
                                                <span class="badge badge-soft-success font-13 p-2">+1,254.00</span>
                                            </div><!--end col-->
                                            <div class="col-xl-6 align-self-center">
                                                <div class="button-items text-right">
                                                    <button type="button"
                                                        class="btn btn-sm btn-gradient-danger waves-effect waves-light"><i
                                                            class="dripicons-arrow-thin-up mr-2"></i>Sent</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-gradient-success waves-effect waves-light"><i
                                                            class="dripicons-arrow-thin-down mr-2"></i>Receive</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div>
                                    <ul class="list-unsyled m-0 pl-0 transaction-history">
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Apple Co Pvt. Ltd</h3>
                                                        <p class="text-muted mb-0">6 June 2019 10:25 AM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$1420.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-down-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Vivo Mobile</h3>
                                                        <p class="text-muted mb-0">4 June 2019 7:05 PM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-success">$3651.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">ICICI Bank Transfer</h3>
                                                        <p class="text-muted mb-0">1 June 2019 11:30 PM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$625.22 CAN</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="mdi mdi-arrow-top-right-thick"></i>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">Sony LLP</h3>
                                                        <p class="text-muted mb-0">28 May 2019 08:45 AM</p>
                                                    </div>
                                                </div><!--end media body-->
                                            </div>
                                            <span class="text-danger">$6621.00 USA</span>
                                        </li>
                                        <li class="align-items-center d-flex justify-content-end">
                                            <a href="#" class="">View All<i
                                                    class="dripicons-arrow-thin-right ml-2"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end tab-pane-->
                            </div><!--end tab-content-->
                        </div> <!--end balence-nav-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!-- container -->


    <!-- Account Modal -->
    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountModalTitle">Account Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('dashboard')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date" class="control-label">Date:</label>
                            <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control" id="date" readonly>
                        </div>
                        @foreach ($accountAll as $account)
                        <div class="form-group">
                            <input type="checkbox" name="account_id[]" value="{{$account->id}}" class="form-control" id="title{{$account->id}}">
                            <label for="title{{$account->id}}" class="control-label">{{$account->title}} ({{$account->bank_name}})</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Load Modal -->
    <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="loadModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loadModalTitle">Deposit Load</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('load.deposit')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date" class="control-label">Date:</label>
                            <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control" id="date" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="load_id" class="control-label">Load Account</label>
                            <select name="load_id" id="load_id" class="form-control" required>
                                @foreach ($loads as $load)
                                <option value="{{$load->id}}">{{$load->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#date').change(function(){

            });
        });
    </script>
@endsection
