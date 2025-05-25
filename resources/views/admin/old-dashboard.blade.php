@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container-fluid">

    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-8"><h2>0 <i class="ti-angle-down font-14 text-danger"></i></h2>
                            <h6>Order Received</h6></div>
                        <div class="col-4 align-self-center text-right  p-l-0">
                            <div id="sparklinedash3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-8"><h2 class="">0 <i class="ti-angle-up font-14 text-success"></i></h2>
                            <h6>Tax Deduction</h6></div>
                        <div class="col-4 align-self-center text-right p-l-0">
                            <div id="sparklinedash"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-8"><h2>0 <i class="ti-angle-up font-14 text-success"></i></h2>
                            <h6>Revenue Stats</h6></div>
                        <div class="col-4 align-self-center text-right p-l-0">
                            <div id="sparklinedash2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-8"><h2>0% <i class="ti-angle-down font-14 text-danger"></i></h2>
                            <h6>Yearly Sales</h6></div>
                        <div class="col-4 align-self-center text-right p-l-0">
                            <div id="sparklinedash4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->

    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">EasyPaisa/Jazz Cash Commission</h4>
                        </div>
                    </div>
                    <div>
                        <form action="{{Route('close.mobile_wallet')}}" method="POST">
                            @csrf
                            <input type="hidden" name="date" value="{{$date}}">
                            <table class="table">
                                <tr>
                                    <td>EasyPaisa/JazzCash</td>
                                    <td><input type="number" name="commission" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>Rs: 0</td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">Accessories Sale</h4>
                        </div>
                        <div class="ml-auto">
                            <a href="{{Route('accessory.sale')}}" class="btn btn-primary">Sale</a>
                        </div>
                    </div>
                    <div>
                        <form action="" method="POST">
                            @csrf
                            <table class="table">
                                <tr>
                                    <td>Total Purchase</td>
                                    <td>Total Sale</td>
                                    <td>Total Profit</td>
                                </tr>
                                <tr>
                                    <td>Rs: 0</td>
                                    <td>Rs: 0</td>
                                    <td>Rs: 0</td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">Load</h4>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#loadModal" data-whatever="@mdo">Deposit</button>
                        </div>
                    </div>
                    <div>
                        <form action="{{Route('close.load')}}" method="POST">
                            @csrf
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Current Balance</th>
                                    {{-- <th>Comm</th> --}}
                                </tr>
                                @foreach ($loads as $load)
                                <input type="hidden" name="load_id[]" value="{{$load->id}}">
                                <input type="hidden" name="date" value="{{$date}}">
                                <tr>
                                    <td><label>{{$load->title}}</label></td>
                                    <td><input type="text" name="amount[]" class="form-control"></td>
                                    {{-- <td><input type="text" name="commission[]" class="form-control"></td> --}}
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rs: 0</td>
                                    {{-- <td>Rs: 40000</td> --}}
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">Accounts</h4>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#accountModal" data-whatever="@mdo">Filter</button>
                        </div>
                    </div>
                    <div>
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
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">Accounts</h4>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#accountModal" data-whatever="@mdo">Filter</button>
                        </div>
                    </div>
                    <div>
                        <table class="table">
                            <tr>
                                <th>Date</th>
                                <th>User Name</th>
                                <th>Type</th>
                                <th>Account Name</th>
                                <th>Description</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                            @php
                                $debit =$currentBalance;
                                $credit =0;
                                $balance = $currentBalance;
                            @endphp
                            <tr>
                                <td>{{$date}}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Opening</td>
                                <td>{{$debit}}</td>
                                <td>-</td>
                                <td>{{$currentBalance}}</td>
                            </tr>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->transaction_date}}</td>
                                <td>{{$transaction->user->name}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{ optional($transaction->transactionable)->title ?? 'N/A' }}</td>
                                <td>{{$transaction->description}}</td>
                                @if($transaction->type == 'deposit' || $transaction->type == 'sale')
                                @php
                                    $debit +=$transaction->amount;
                                    $balance = $debit-$credit;
                                @endphp
                                <td>{{$transaction->amount}}</td>
                                <td>-</td>
                                <td>{{$balance}}</td>
                                @else
                                @php
                                    $credit +=$transaction->amount;
                                    $balance = $debit-$credit;
                                @endphp
                                <td>-</td>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$balance}}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="5">Total</th>
                                <th>{{$debit}}</th>
                                <th>{{$credit}}</th>
                                <th>{{$balance}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="accountModalLabel1">Add Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{Route('dashboard')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date" class="control-label">Date:</label>
                        <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control" id="date">
                    </div>
                    @foreach ($accountAll as $account)
                    <div class="form-group">
                        <input type="checkbox" name="account_id[]" value="{{$account->id}}" class="form-control" id="title{{$account->id}}">
                        <label for="title{{$account->id}}" class="control-label">{{$account->title}} ({{$account->bank_name}})</label>
                    </div>
                    @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="loadModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="loadModalLabel1">Deposit Load</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{Route('load.deposit')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date" class="control-label">Date:</label>
                        <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control" id="date" required>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/2.jpg') }}" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/3.jpg') }}" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/4.jpg') }}" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/5.jpg') }}" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/6.jpg') }}" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/7.jpg') }}" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('admin/assets/images/users/8.jpg') }}" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
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
