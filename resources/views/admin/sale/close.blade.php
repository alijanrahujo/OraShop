@extends('layouts.admin2')
@section('title', 'Sale Close')
@section('content')

    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ env('APP_NAME') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Sale</a></li>
                            <li class="breadcrumb-item active">Close</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sale Close</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('sale.closestore') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Item</th>
                                                <th>Category</th>
                                                <th>Purchase Price</th>
                                                <th>Qty Price</th>
                                                <th>Selling Price</th>
                                                <th>Total</th>
                                                <th>Commission (10%)</th>
                                                <th>Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                                $total_purchase_price = 0;
                                                $total_selling_price = 0;
                                                $total_qty = 0;
                                                $total_commission = 0;
                                                $total_profit = 0;
                                            @endphp
                                            @foreach ($sales as $sale)
                                            @php
                                                $total += $sale->unit_cost * $sale->qty;
                                                $total_selling_price += $sale->unit_cost * $sale->qty;
                                                $total_purchase_price += $sale->accessory->purchase_price * $sale->qty;
                                                $commission = ($sale->unit_cost - $sale->accessory->purchase_price) * (10 / 100) * $sale->qty;
                                                $total_commission += $commission;
                                                $profit = ($sale->unit_cost - $sale->accessory->purchase_price) * $sale->qty - $commission;
                                                $total_profit += $profit;
                                                $total_qty += $sale->qty;
                                            @endphp
                                                <tr align="center">
                                                    <td align="left">{{ $sale->accessory->code }}</td>
                                                    <td align="left">{{ $sale->accessory->title }}</td>
                                                    <td align="left">{{ $sale->accessory->category->title }}</td>
                                                    <td>{{ number_format($sale->accessory->purchase_price,0) }}</td>
                                                    <td>{{ number_format($sale->qty,0) }}</td>
                                                    <td>{{ number_format($sale->unit_cost,0) }}</td>
                                                    <td>{{ number_format($sale->unit_cost * $sale->qty,0) }}</td>
                                                    <td>{{ $commission = number_format(($sale->unit_cost - $sale->accessory->purchase_price) * (10 / 100) * $sale->qty,2) }}</td>
                                                    <td>{{ number_format(($sale->unit_cost - $sale->accessory->purchase_price) * $sale->qty - $commission,2) }}</td>

                                                    <input type="hidden" name="sale_detail_id[]" value="{{ $sale->id }}">
                                                    <input type="hidden" name="code[]" value="{{ $sale->accessory->code }}">
                                                    <input type="hidden" name="title[]" value="{{ $sale->accessory->title }}">
                                                    <input type="hidden" name="category[]" value="{{ $sale->accessory->category->title }}">
                                                    <input type="hidden" name="purchase_price[]" value="{{ $sale->accessory->purchase_price }}">
                                                    <input type="hidden" name="qty[]" value="{{ $sale->qty }}">
                                                    <input type="hidden" name="unit_cost[]" value="{{ $sale->unit_cost }}">
                                                    <input type="hidden" name="total_qty[]" value="{{ $sale->unit_cost * $sale->qty }}">
                                                    <input type="hidden" name="commission[]" value="{{ $commission }}">
                                                    <input type="hidden" name="profit[]" value="{{ ($sale->unit_cost - $sale->accessory->purchase_price) * $sale->qty - $commission}}">
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr align="center">
                                                <th></th>
                                                <th></th>
                                                <th>Total</th>
                                                <th>{{number_format($total_purchase_price,0)}}</th>
                                                <th>{{number_format($total_qty,0)}}</th>
                                                <th>{{number_format($total_selling_price,0)}}</th>
                                                <th>{{number_format($total,0)}}</th>
                                                <th>{{number_format($total_commission,2)}}</th>
                                                <th>{{number_format($total_profit,2)}}</th>
                                                <input type="hidden" name="date" value="{{ $date }}">
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-gradient-primary"  onclick="return confirm('Are you sure you want to submit?')">Submit</button>
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
        $(document).ready(function() {
            function updateGrandTotal() {
                let total = 0;
                $("#accessory-table tbody tr").each(function() {
                    let rowTotal = parseFloat($(this).find(".total").text());
                    if (!isNaN(rowTotal)) total += rowTotal;
                });
                $("#grand-total").text(total.toFixed(2));
            }

            $("#search").on("input", function() {
                let value = $(this).val().toLowerCase();
                if (value) {
                    $("#suggestion-box").show();
                    $(".suggestion-item").each(function() {
                        let text = $(this).text().toLowerCase();
                        $(this).toggle(text.includes(value));
                    });
                } else {
                    $("#suggestion-box").hide();
                }
            });

            $(document).on("click", ".suggestion-item", function(e) {
                e.preventDefault();

                let name = $(this).data("name");
                let price = parseFloat(0);
                // let price = parseFloat($(this).data("price"));
                let id = $(this).data("id");


                $("#accessory-table tbody").append(`
            <tr data-id="${id}">
                <td>${name} <input type="hidden" name="accessory_id[]" value="${id}"></td>
                <td class="unit-price"><input type="number" class="form-control form-control-sm price-input" name="price[]" value="${price.toFixed(2)}" min="1"></td>
                <td><input type="number" class="form-control form-control-sm qty-input" name="qty[]" value="1" min="1"></td>
                <td class="total">${price.toFixed(2)}</td>
                <td><button type="button" class="btn btn-sm btn-danger delete-row">Delete</button></td>
            </tr>
        `);


                updateGrandTotal();
                $("#search").val('');
                $("#accessory_id").val('');
                $("#suggestion-box").hide();
            });

            $(document).on("input", ".qty-input", function() {
                let qty = parseInt($(this).val());
                if (qty < 1 || isNaN(qty)) qty = '';
                $(this).val(qty);

                let row = $(this).closest("tr");
                let price = parseFloat(row.find(".price-input").val()) || 0;
                row.find(".total").text((qty * price).toFixed(2));

                updateGrandTotal();
            });

            $(document).on("input", ".price-input", function() {
                let row = $(this).closest("tr");
                let qty = parseInt(row.find(".qty-input").val()) || 1;
                let price = parseFloat($(this).val()) || 0;
                row.find(".total").text((qty * price).toFixed(2));

                updateGrandTotal();
            });


            $(document).on("click", ".delete-row", function() {
                $(this).closest("tr").remove();
                updateGrandTotal();
            });

            $(document).on("click", function(e) {
                if (!$(e.target).closest("#search, #suggestion-box").length) {
                    $("#suggestion-box").hide();
                }
            });
        });
    </script>

@endsection
