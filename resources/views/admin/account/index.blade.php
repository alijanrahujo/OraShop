@extends('layouts.admin')
@section('title', 'Account Management')
@section('content')

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Account</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Account List</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="text-right mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#createModal">Add Account</button>
                        </div>
                        {{-- <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted mb-3">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>S#</th>
                                    <th>Title</th>
                                    <th>Bank Name</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->title }}</td>
                                        <td>{{ $account->bank_name }}</td>
                                        <td>{{ $account->balance }}</td>
                                        <td>{{ $account->status ? 'Actice' : 'Deactive' }}</td>
                                        <td class="text-right">
                                            {{-- <button type="button" class="btn btn-sm btn-success deposit"
                                                data-account_id="{{ $account->id }}" data-toggle="modal"
                                                data-target="#depositModal" data-whatever="@mdo">Deposit</button> --}}
                                            <a href="{{ route('account.edit', $account->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('account.destroy', $account->id) }}" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('Are you sure you want to delete this?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container -->


    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">Create Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('account.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="control-label">Title: <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_name" class="control-label">Bank Name: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="bank_name" class="form-control" id="bank_name" required>
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

    <!-- Deposit Modal -->
    <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="depositModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="depositModalTitle">Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('account.deposit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="account_id" id="account_id" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date" class="control-label">Date: <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Amount: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" id="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description: <span
                                    class="text-danger">*</span></label>
                            <input type="description" name="description" class="form-control" id="description" required>
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
        $('.deposit').click(function() {
            var account_id = $(this).data('account_id');
            $('#account_id').val(account_id);
        })
    </script>
@endsection
