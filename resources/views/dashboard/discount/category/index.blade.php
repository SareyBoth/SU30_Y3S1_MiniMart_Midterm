<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title>PrimeMart - Coupons</title>

    @include('dashboard.components.style')

</head>

<body>
    <div class="main-wrapper">

        @include('dashboard.components.header')

        @include('dashboard.components.sidebar')

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-6">
                        <h4 class="page-title">Discount Category</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right">
                        <a href="{{ route('dashboard.coupon.create') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Coupon</a>
                    </div>
                </div>

                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Expires On</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td><strong>{{ $category->category_id }}</strong></td>
                                        <td>{{ ucfirst($category->discount_type) }}</td>
                                        <td>
                                            @if ($category->discount_type == 'percent')
                                            {{ $category->discount_value }}%
                                            @else
                                            ${{ number_format($category->discount_value, 2) }}
                                            @endif
                                        </td>
                                        <td>{{ $category->valid_until ? $category->valid_until->format('M d, Y') : 'Never' }}</td>
                                        <td class="text-center">
                                            @if ($category->is_active)
                                            <span class="custom-badge status-green">Active</span>
                                            @else
                                            <span class="custom-badge status-red">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="delete-btn" data-toggle="modal" data-target="#delete_modal" title="Delete" data-id="{{ $category->id }}">
                                                <i class="fa fa-trash" style="color: #dc3545; font-size: 16px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Discount found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    <div class="pagination-container mt-5 mb-5 d-flex justify-content-end">
                        {{ $categories->links('pagination::bootstrap-4') }}
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="delete_modal" class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h3>Are you sure you want to delete this coupon?</h3>
                        <div class="m-t-20">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <form id="delete-form" action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // When a delete button is clicked
            $('.delete-btn').on('click', function() {
                // Get the coupon ID from the data-id attribute
                var couponId = $(this).data('id');
                // Create the URL for the form's action attribute
                var url = "{{ url('dashboard/coupon') }}/" + couponId;
                // Set the form's action attribute
                $('#delete-form').attr('action', url);
            });
        });
    </script>

</body>

</html>