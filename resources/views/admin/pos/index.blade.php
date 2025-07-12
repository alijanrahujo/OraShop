@extends('layouts.admin')
@section('title', 'Accessory Management')
@section('content')
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .left-panel {
            border-right: 1px solid #ddd;
            background-color: #fff;
            padding: 15px;
        }

        .product-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            height: 170px;
            background-color: white;
            margin-top: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .product-card img {
            height: 80px;
            object-fit: contain;
            margin-bottom: 5px;
            transition: transform 0.2s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .category-btn {
            margin-right: 5px;
            border-radius: 20px;
            padding: 5px 15px;
            font-weight: 500;
        }

        .category-btn.active {
            background-color: #7f55e0;
            color: white;
            box-shadow: 0 0 6px rgba(127, 85, 224, 0.4);
        }

        .totals {
            background-color: #e6e6fb;
            font-weight: bold;
            padding: 12px;
            text-align: center;
            font-size: 20px;
            border-radius: 10px;
        }

        .btn-cash {
            background-color: #1abc9c;
            color: white;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .btn-cash:hover {
            background-color: #16a085;
        }

        .btn-cancel {
            background-color: #e74c3c;
            color: white;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }

        .cart {
            height: 400px;
            overflow-y: auto;
        }

        .product-grid {
            height: 550px;
            overflow-y: auto;
        }

        /* Custom Scrollbar */
        .cart::-webkit-scrollbar,
        .product-grid::-webkit-scrollbar {
            width: 8px;
        }

        .cart::-webkit-scrollbar-track,
        .product-grid::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .cart::-webkit-scrollbar-thumb,
        .product-grid::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .cart::-webkit-scrollbar-thumb:hover,
        .product-grid::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        /* Optional scrollbar for Firefox */
        .cart,
        .product-grid {
            scrollbar-width: thin;
            scrollbar-color: #ccc #f1f1f1;
        }

        table.table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
    </style>

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
                        <div class="row">
                            <!-- Left Panel -->
                            <div class="col-md-5 left-panel">
                                <form action="{{Route('pos.store')}}" method="post">
                                    @csrf
                                    {{-- <input id="product-search" class="form-control mb-2" placeholder="Scan/Search product by name/code"> --}}
                                    <input type="date" name="date" class="form-control mb-2" value="{{date('Y-m-d')}}">
                                    <!-- Cart Table -->
                                    <div class="cart">
                                        <table class="table table-bordered text-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cart-body">
                                                <!-- JS adds rows here -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-between px-2 mt-2">
                                        <span>Items: <span id="item-count">0</span></span>
                                        <span>Total: <span id="total-amount">0.00</span></span>
                                        {{-- <span>Shipping: <span>0.00</span></span> --}}
                                    </div>

                                    <div class="totals mt-2">Grand Total <span id="grand-total">0.00</span></div>

                                    <button class="btn btn-primary w-100 mt-3">Sale Out</button>
                                </form>
                            </div>

                            <!-- Right Panel -->
                            <div class="col-md-7">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <button class="btn category-btn active" data-category="all">All</button>
                                        @foreach ($categories as $category)
                                            <button class="btn category-btn"
                                                data-category="{{ $category->title }}">{{ $category->title }}</button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Product Grid -->
                                <div class="row product-grid">
                                    <!-- Sample Products -->
                                    @foreach ($accessories as $accessory)
                                        <div class="col-md-3 mb-3 product-item"
                                            data-category="{{ $accessory->category->title??'' }}"
                                            data-id="{{ $accessory->id }}"
                                            data-name="{{ $accessory->title }}"
                                            data-quantity="{{ $accessory->quantity }}"
                                            data-code="{{ $accessory->id }}">
                                            <div class="product-card">
                                                <img src="{{ asset('storage/' . $accessory->image) }}"
                                                    alt="{{ $accessory->title }}">
                                                <div>{{ $accessory->title }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
                <form action="{{ Route('accessory.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="purchase_price" class="control-label">Purchase Price: <span
                                    class="text-danger">*</span></label>
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

@endsection
@section('script')
    <script>
        // Category Filter
        $('.category-btn').click(function() {
            $('.category-btn').removeClass('active');
            $(this).addClass('active');

            const category = $(this).data('category');

            if (category === 'all') {
                $('.product-item').show();
            } else {
                $('.product-item').hide();
                $(`.product-item[data-category="${category}"]`).show();
            }
        });

        // Add to Cart with manual price
        $('.product-item').click(function() {
            const name = $(this).data('name');
            const id = $(this).data('id');
            const quantity = $(this).data('quantity');

            if(quantity < 1){
                alert("Out of stock.");
                return;
            }

            let price = prompt(`Enter price for "${name}"`);
            if (price === null || isNaN(price) || price.trim() === "") {
                alert("Invalid price entered.");
                return;
            }
            price = parseFloat(price).toFixed(2);

            const existingRow = $(`#cart-body tr[data-name="${name}"]`);
            if (existingRow.length) {
                const qtyInput = existingRow.find('.qty');
                qtyInput.val(parseInt(qtyInput.val()) + 1).trigger('input');
            } else {
                $('#cart-body').append(`
                <tr data-name="${name}">
                  <td>${name}</td>
                  <td><input type="number" class="form-control price" name="price[]" value="${price}" min="0" style="width: 80px;"></td>
                  <td><input type="number" class="form-control qty" name="qty[]" value="1" min="1" style="width: 70px;"></td>
                  <td class="subtotal">${price}</td>
                  <input type="hidden" name="accessory_id[]" value="${id}">
                  <input type="hidden" class="stock" value="${quantity}">
                  <td><button class="btn btn-sm btn-danger remove-item">X</button></td>
                </tr>
            `);
            }

            updateTotals();
        });

        // Update subtotal when qty or price changes
        $('#cart-body').on('input', '.qty, .price', function() {
            const row = $(this).closest('tr');
            const price = parseFloat(row.find('.price').val());
            const qty = parseInt(row.find('.qty').val());
            const stock = parseInt(row.find('.stock').val());
            if(stock <= qty)
            {
                row.find('.qty').val(stock);
                qty = parseInt(stock);
            }
            const subtotal = (price * qty).toFixed(2);
            row.find('.subtotal').text(subtotal);

            updateTotals();
        });

        // Remove item from cart
        $('#cart-body').on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
            updateTotals();
        });

        // Update totals
        function updateTotals() {
            let total = 0;
            let items = 0;

            $('#cart-body tr').each(function() {
                const qty = parseInt($(this).find('.qty').val());
                const price = parseFloat($(this).find('.price').val());
                total += price * qty;
                items += qty;
            });

            $('#item-count').text(items);
            $('#total-amount').text(total.toFixed(2));
            $('#grand-total').text(total.toFixed(2));
        }

        $('#product-search').on('input', function () {
        const search = $(this).val().toLowerCase().trim();

        $('.product-item').each(function () {
            const name = $(this).data('name').toLowerCase();
            const code = $(this).data('code') ? $(this).data('code') : '';

            if (name.includes(search) || code.includes(search)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    </script>
@endsection
