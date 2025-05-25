@extends('layouts.admin')
@section('title', 'Account Report')
@section('content')

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Account Report</a></li>
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Account Report</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ Route('report.account') }}" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date" class="control-label">Date: <span class="text-danger">*</span></label>
                                        <input type="date" name="date" value="{{$request->date}}" class="form-control" id="date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted mb-3">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}

                        <table id="datatable-report" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Bank Name</th>
                                    <th>Deposit</th>
                                    <th>Withdrawal</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $balance = 0;
                                    $deposit = 0;
                                    $withdrawal = 0;
                                ?>

                                @foreach ($data as $value)
                                    <?php
                                        if($value->type == 'deposit')
                                        {
                                            $deposit += $value->amount;
                                            $balance += $value->amount;
                                        }
                                        else if($value->type == 'withdrawal')
                                        {
                                            $withdrawal += $value->amount;
                                            $balance -= $value->amount;
                                        }
                                    ?>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->transaction_date }}</td>
                                        <td>{{ optional($value->transactionable)->title ?? 'N/A' }}</td>
                                        <td>{{ optional($value->transactionable)->bank_name ?? 'N/A' }}</td>
                                        <td>{{ ($value->type == 'deposit')? $value->amount: '' }}</td>
                                        <td>{{ ($value->type == 'withdrawal')? $value->amount: '' }}</td>
                                        <td>{{ $balance }}</td>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Grand Total</th>
                                    <th>{{ $deposit }}</th>
                                    <th>{{ $withdrawal }}</th>
                                    <th colspan="2">{{ $balance }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container -->

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#datatable-report').DataTable({
                paging: false,
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#datatable-report_wrapper .col-md-6:eq(0)');

            $('#row_callback').DataTable({
                "createdRow": function(row, data, index) {
                    if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
                        $('td', row).eq(5).addClass('highlight');
                    }
                }
            });
        });
    </script>
@endsection
