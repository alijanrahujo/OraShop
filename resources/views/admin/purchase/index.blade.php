@extends('layouts.admin2')
@section('title', 'Purchase Management')
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
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Purchase List</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="text-right mb-3">
                            <a href="{{ Route('purchase.create') }}" class="btn btn-primary">Add Purchase</a>
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
                                <tr>
                                    <th>S#</th>
                                    <th>Supplier</th>
                                    <th>Ref No</th>
                                    <th>Items</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->supplier }}</td>
                                    <td>{{ $purchase->reference_no }}</td>
                                    <td>{{ $purchase->items }}</td>
                                    <td>{{ $purchase->grand_total }}</td>
                                    <td>{{ $purchase->date }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('purchase.show', $purchase->id) }}"
                                            class="btn btn-sm btn-primary">Show</a>
                                        <a href="{{ route('purchase.edit', $purchase->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger delete-purchase"
                                            data-id="{{ $purchase->id }}"
                                            data-toggle="modal" data-target="#deleteModal">Delete</button>
                                    </td>
                                </tr>
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
                    <h5 class="modal-title" id="createModalTitle">Create Accessory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('accessory.store')}}" method="POST" enctype="multipart/form-data">
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
                            <label for="purchase_price" class="control-label">Purchase Price: <span class="text-danger">*</span></label>
                            <input type="number" name="purchase_price" class="form-control" id="purchase_price" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label">Image:</label>
                            <input type="file" name="image" class="form-control" id="image">
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle">Delete Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="deleteForm">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete this purchase?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $('.delete-purchase').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', 'purchase/' + id);
    });
</script>
@endsection
