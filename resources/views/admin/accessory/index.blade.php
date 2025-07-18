@extends('layouts.admin')
@section('title', 'Accessory Management')
@section('content')

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Accessory</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Accessory List</h4>
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
                                data-target="#createModal">Add Accessory</button>
                        </div>
                        {{-- <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted mb-3">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>S#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Category</th>
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
                                    {{-- <td><img src="{{ asset('storage/' . $accessory->image) }}" width="60"></td> --}}
                                    <td><img src="{{ asset($accessory->image ? 'storage/' . $accessory->image : 'admin/assets/images/no-image.png') }}"
     alt="{{ $accessory->title }}" width="60"></td>
                                    <td>{{ $accessory->title }}</td>
                                    <td>{{ $accessory->code }}</td>
                                    <td>{{ $accessory->category->title??'' }}</td>
                                    <td>{{ $accessory->purchase_price }}</td>
                                    <td>{{ $accessory->quantity }}</td>
                                    <td>{{ ($accessory->status)?'Actice':'Deactive' }}</td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-warning edit-accessory"
                                            data-id="{{ $accessory->id }}"
                                            data-title="{{ $accessory->title }}"
                                            data-category_id="{{ $accessory->category->id??''}}"
                                            data-description="{{ $accessory->description }}"
                                            data-purchase_price="{{ $accessory->purchase_price }}"
                                            data-status="{{ $accessory->status }}"
                                            data-toggle="modal" data-target="#editModal">Edit</button>
                                        <form action="{{ route('accessory.destroy', $accessory->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
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
                            <label for="category" class="control-label">Category: <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" id="category" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Edit Accessory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title" class="control-label">Title: <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="edit_title" required>
                        </div>
                        <div class="form-group">
                            <label for="category" class="control-label">Category: <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" id="edit_category" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_description" class="control-label">Description:</label>
                            <input type="text" name="description" class="form-control" id="edit_description">
                        </div>
                        <div class="form-group">
                            <label for="edit_purchase_price" class="control-label">Purchase Price: <span class="text-danger">*</span></label>
                            <input type="number" name="purchase_price" class="form-control" id="edit_purchase_price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image" class="control-label">Image:</label>
                            <input type="file" name="image" class="form-control" id="edit_image">
                        </div>
                        <div class="form-group">
                            <label for="edit_status" class="control-label">Status:</label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $('.edit-accessory').click(function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var category_id= $(this).data('category_id');
        var description = $(this).data('description');
        var purchase_price = $(this).data('purchase_price');
        var status = $(this).data('status');
        $('#edit_title').val(title);
        $('#edit_category').val(category_id);
        $('#edit_description').val(description);
        $('#edit_purchase_price').val(purchase_price);
        $('#edit_status').val(status);
        $('#editForm').attr('action', 'accessory/' + id);
    });
</script>
@endsection
