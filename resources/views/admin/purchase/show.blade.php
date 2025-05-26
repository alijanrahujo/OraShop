@extends('layouts.admin')
@section('title', 'Purchase Details')
@section('content')

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Purchase</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Purchase Details</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body print-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mt-0 header-title">Purchase Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>Purchase ID</th>
                                                        <td>{{ $purchase->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date</th>
                                                        <td>{{ $purchase->date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Items</th>
                                                        <td>{{ $purchase->items }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>Total Quantity</th>
                                                        <td>{{ $purchase->qty }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount</th>
                                                        <td>Rs. {{ number_format($purchase->grand_total, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>{{ $purchase->status }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h4 class="mt-0 header-title">Purchase Items</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($purchaseDetails as $detail)
                                                <tr>
                                                    <td>
                                                        @if($detail->accessory->image)
                                                            <img src="{{ asset('storage/' . $detail->accessory->image) }}" 
                                                                 alt="{{ $detail->accessory->title }}" 
                                                                 class="img-thumbnail" 
                                                                 style="max-width: 100px;">
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}" 
                                                                 alt="No Image" 
                                                                 class="img-thumbnail" 
                                                                 style="max-width: 100px;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $detail->accessory->title }}</td>
                                                    <td>{{ $detail->qty }}</td>
                                                    <td>Rs. {{ number_format($detail->unit_cost, 2) }}</td>
                                                    <td>Rs. {{ number_format($detail->qty * $detail->unit_cost, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-end">Grand Total:</th>
                                                <th>Rs. {{ number_format($purchase->grand_total, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 no-print">
                            <div class="col-12">
                                <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-gradient-primary">Edit</a>
                                <a href="{{ route('purchase.index') }}" class="btn btn-gradient-danger">Back</a>
                                <button onclick="printContent()" class="btn btn-gradient-info">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container -->

    
    <script>
        function printContent() {
            var printContent = document.querySelector('.print-body').innerHTML;
            var originalContent = document.body.innerHTML;
            
            var printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Purchase Details</title>
                        <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
                        <style>
                            body {
                                padding: 20px;
                            }
                            .table {
                                width: 100%;
                                margin-bottom: 1rem;
                                border-collapse: collapse;
                            }
                            .table th, .table td {
                                padding: 0.75rem;
                                border: 1px solid #dee2e6;
                            }
                            .table-bordered {
                                border: 1px solid #dee2e6;
                            }
                            .img-thumbnail {
                                max-width: 100px;
                                height: auto;
                            }
                            .text-end {
                                text-align: right;
                            }
                        </style>
                    </head>
                    <body>
                        ${printContent}
                    </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            
            // Wait for images to load
            setTimeout(function() {
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>

@endsection 