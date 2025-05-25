@extends('layouts.admin')
@section('title', 'Purchase Create')
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
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Purchase Create</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <input type="text" class="form-control" name="supplier" value="{{old('supplier')}}" id="supplier" placeholder="Supplier">
                                        @error('supplier')
                                            <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reference_no">Reference No</label>
                                        <input type="text" class="form-control" name="reference_no" value="{{old('reference_no')}}" id="reference_no" placeholder="Reference No">
                                        @error('reference_no')
                                            <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="4">Received</option>
                                            <option value="3">Partial</option>
                                            <option value="2">Pending</option>
                                            <option value="1">Ordered</option>
                                        </select>
                                        @error('status')
                                            <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="attach_document">Attach Document</label>
                                        <div class="custom-file mb-3">
                                            <input type="file" name="attach_document" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('attach_document')
                                            <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Purchase Date</label>
                                        <input type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" id="date" placeholder="Date Purchase">
                                        @error('date')
                                            <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group position-relative" style="width: 100%;">
                                        <input type="text" class="form-control" name="search" id="search" autocomplete="off" placeholder="Search accessories...">
                                        <div id="suggestion-box" class="list-group position-absolute w-100" style="z-index: 1000; display: none;">
                                            @foreach ($accessories as $accessory)
                                                <a href="#" class="list-group-item list-group-item-action suggestion-item"
                                                data-id="{{ $accessory->id }}"
                                                data-name="{{ $accessory->title }}"
                                                data-price="{{ $accessory->purchase_price }}">
                                                    <strong>{{ $accessory->title }}</strong> - Rs. {{ $accessory->purchase_price }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table mt-3" id="accessory-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price (Rs.)</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-end">Grand Total:</th>
                                                <th id="grand-total">0.00</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-gradient-primary">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-gradient-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container -->

@endsection
@section('script')
    <script>
$(document).ready(function () {
    function updateGrandTotal() {
        let total = 0;
        $("#accessory-table tbody tr").each(function () {
            let rowTotal = parseFloat($(this).find(".total").text());
            if (!isNaN(rowTotal)) total += rowTotal;
        });
        $("#grand-total").text(total.toFixed(2));
    }

    $("#search").on("input", function () {
        let value = $(this).val().toLowerCase();
        if (value) {
            $("#suggestion-box").show();
            $(".suggestion-item").each(function () {
                let text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(value));
            });
        } else {
            $("#suggestion-box").hide();
        }
    });

    $(document).on("click", ".suggestion-item", function (e) {
        e.preventDefault();

        let name = $(this).data("name");
        let price = parseFloat($(this).data("price"));
        let id = $(this).data("id");

        let existingRow = $(`#accessory-table tbody tr[data-id="${id}"]`);

        if (existingRow.length > 0) {
            let qtyInput = existingRow.find(".qty-input");
            let qty = parseInt(qtyInput.val()) + 1;
            qtyInput.val(qty);
            existingRow.find(".total").text((qty * price).toFixed(2));
        } else {
            $("#accessory-table tbody").append(`
                <tr data-id="${id}">
                    <td>${name} <input type="hidden" name="accessory_id[]" value="${id}"></td>
                    <td class="unit-price"><input type="number" class="form-control form-control-sm price-input" name="price[]" value="${price.toFixed(2)}" min="1"></td>
                    <td><input type="number" class="form-control form-control-sm qty-input" name="qty[]" value="1" min="1"></td>
                    <td class="total">${price.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-sm btn-danger delete-row">Delete</button></td>
                </tr>
            `);
        }

        updateGrandTotal();
        $("#search").val('');
        $("#accessory_id").val('');
        $("#suggestion-box").hide();
    });

   $(document).on("input", ".qty-input", function () {
        let qty = parseInt($(this).val());
        if (qty < 1 || isNaN(qty)) qty = '';
        $(this).val(qty);

        let row = $(this).closest("tr");
        let price = parseFloat(row.find(".price-input").val()) || 0;
        row.find(".total").text((qty * price).toFixed(2));

        updateGrandTotal();
    });

    $(document).on("input", ".price-input", function () {
        let row = $(this).closest("tr");
        let qty = parseInt(row.find(".qty-input").val()) || 1;
        let price = parseFloat($(this).val()) || 0;
        row.find(".total").text((qty * price).toFixed(2));

        updateGrandTotal();
    });


    $(document).on("click", ".delete-row", function () {
        $(this).closest("tr").remove();
        updateGrandTotal();
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest("#search, #suggestion-box").length) {
            $("#suggestion-box").hide();
        }
    });
});
</script>

@endsection
