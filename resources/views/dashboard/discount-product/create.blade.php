<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <title>Add Product Discount - PrimeMart</title>

    <!-- Style -->
    @include('dashboard.components.style')

    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
</head>
<body>
    <div class="main-wrapper">
        <!-- Header -->
        @include('dashboard.components.header')
        <!-- Sidebar -->
        @include('dashboard.components.sidebar')

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-6">
                        <h4 class="page-title">Add Product Discount</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right m-b-20">
                        <a href="{{ route('dashboard.discount-product.index') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('dashboard.discount-product.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Product</label>
                                <select class="form-control" name="product_id" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discount Type</label>
                                        <select class="form-control" name="discount_type" required>
                                            <option value="percent">Percentage</option>
                                            <option value="fixed">Fixed Amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discount Value</label>
                                        <input class="form-control" type="number" step="0.01" name="discount_value" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Valid From</label>
                                        <input class="form-control" type="datetime-local" name="valid_from">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Valid Until</label>
                                        <input class="form-control" type="datetime-local" name="valid_until">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">
                                        Is Active
                                    </label>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Discount</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
</body>
</html>
