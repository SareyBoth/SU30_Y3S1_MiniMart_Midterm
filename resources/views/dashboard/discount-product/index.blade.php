<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <title>Product Discounts - PrimeMart</title>

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
                        <h4 class="page-title">Product Discounts</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right m-b-20">
                        <a href="{{ route('dashboard.discount-product.create') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Discount</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Value</th>
                                        <th>Valid From</th>
                                        <th>Valid Until</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($discounts as $discount)
                                    <tr>
                                        <td>{{ $discount->product->name ?? 'N/A' }}</td>
                                        <td class="text-center">{{ ucfirst($discount->discount_type) }}</td>
                                        <td class="text-center">
                                            @if($discount->discount_type == 'percent')
                                            {{ $discount->discount_value }}%
                                            @else
                                            ${{ number_format($discount->discount_value, 2) }}
                                            @endif
                                        </td>
                                        <td>{{ $discount->valid_from ? \Carbon\Carbon::parse($discount->valid_from)->format('M d, Y') : 'N/A' }}</td>
                                        <td>{{ $discount->valid_until ? \Carbon\Carbon::parse($discount->valid_until)->format('M d, Y') : 'N/A' }}</td>
                                        <td class="text-center">
                                            <span class="custom-badge {{ $discount->is_active ? 'status-green' : 'status-red' }}">
                                                {{ $discount->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_discount"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
</body>

</html>