@extends('layouts.admin')
@section('title', 'Load Management')
@section('content')

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Load</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Load List</h4>
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
                                data-target="#createModal">Add Load</button>
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
                                    <th>Description</th>
                                    <th>Balance</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loads as $load)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $load->title }}</td>
                                    <td>{{ $load->description }}</td>
                                    <td>{{ $load->balance }}</td>
                                    <td>{{ $load->commission }}</td>
                                    <td>{{ ($load->status)?'Actice':'Deactive' }}</td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-success deposit"
                                                data-load_id="{{ $load->id }}" data-toggle="modal"
                                                data-target="#depositModal">Deposit</button>

                                        <button type="button" class="btn btn-sm btn-warning edit"
                                        data-load_id="{{ $load->id }}" data-title="{{$load->title}}" data-description="{{$load->description}}" data-commission="{{$load->commission}}" data-toggle="modal"
                                        data-target="#editModal">Edit</button>

                                        <form action="{{ route('load.destroy', $load->id) }}" method="POST"
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
                    <h5 class="modal-title" id="createModalTitle">Create Load Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('load.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="control-label">Title: <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description:</label>
                            <input type="text" name="description" class="form-control" id="description">
                        </div>
                        <div class="form-group">
                            <label for="commission" class="control-label">Commission on 1000: <span class="text-danger">*</span></label>
                            <input type="number" name="commission" value="26" class="form-control" id="commission" required>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">Edit Load Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="editForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="control-label">Title: <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="edittitle" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description:</label>
                            <input type="text" name="description" class="form-control" id="editdescription">
                        </div>
                        <div class="form-group">
                            <label for="commission" class="control-label">Commission on 1000: <span class="text-danger">*</span></label>
                            <input type="number" name="commission" value="26" class="form-control" id="editcommission" required>
                        </div>
                    </div>
                    <input type="hidden" name="load_id" id="editload_id" value="">
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
                <form action="{{Route('load.deposit')}}" method="POST">
                    @csrf
                    <input type="hidden" name="load_id" id="load_id" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date" class="control-label">Date: <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Amount: <span
                                    class="text-danger">*</span></label>
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
        $('.deposit').click(function() {
            var load_id = $(this).data('load_id');
            $('#load_id').val(load_id);
        })

        $('.edit').click(function() {
            var load_id = $(this).data('load_id');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var commission = $(this).data('commission');
            $('#editload_id').val(load_id);
            $('#edittitle').val(title);
            $('#editdescription').val(description);
            $('#editcommission').val(commission);

            $('#editForm').attr('action', 'load/' + load_id);
        })

    </script>
@endsection
