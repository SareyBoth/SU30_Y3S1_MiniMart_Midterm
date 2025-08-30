<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <title>Edit Product Discount - PrimeMart</title>

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
                        <h4 class="page-title">Edit Product Discount</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right m-b-20">
                        <a href="{{ route('dashboard.discount-product.index') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('dashboard.discount-product.update', $discount->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Product (Cannot be changed)</label>
                                <input class="form-control" type="text" value="{{ $discount->product->name }}" disabled>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discount Type</label>
                                        <select class="form-control" name="discount_type" required>
                                            <option value="percentage" {{ $discount->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                            <option value="fixed" {{ $discount->discount_type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discount Value</label>
                                        <input class="form-control" type="number" step="0.01" name="discount_value" value="{{ $discount->discount_value }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Valid From</label>
                                        <input class="form-control" type="datetime-local" name="valid_from" value="{{ $discount->valid_from ? \Carbon\Carbon::parse($discount->valid_from)->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Valid Until</label>
                                        <input class="form-control" type="datetime-local" name="valid_until" value="{{ $discount->valid_until ? \Carbon\Carbon::parse($discount->valid_until)->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $discount->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Is Active
                                    </label>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Discount</button>
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
