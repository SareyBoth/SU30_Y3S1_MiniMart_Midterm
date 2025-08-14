<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>PrimeMart</title>

    <!--Style-->
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Product</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-appointment.html" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Product</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Sub-Category</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-center">{{ $product->id }}</td>
                                        <td class="text-center">{{ $product->id }}</td>
                                        <td class="text-center">${{ $product->price }}</td>
                                        <td class="text-center">{{ $product->stock_quantity }}</td>
                                        <td class="text-center">
                                            <span class="custom-badge {{ $product->status == 1 ? 'status-green' : ($product->status == 2 ? 'status-red' : '') }}">
                                                {{ $product->status == 1 ? 'Active' : ($product->status == 2 ? 'Inactive' : 'Unknown') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <!-- Edit Icon -->
                                            <a href="{{ route('dashboard.product.edit', $product->id) }}" title="Edit">
                                                <i class="fa fa-file-pen mr-2" style="color: #007bff; font-size: 16px; margin-right: 8px;"></i>
                                            </a>

                                            <!-- Delete Icon -->
                                            <a href="#" data-toggle="modal" data-target="#delete_product" title="Delete" data-id="{{ $product->id }}">
                                                <i class="fa fa-trash" style="color: #dc3545; font-size: 16px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-container mt-5 mb-5 d-flex justify-content-end">
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete_product" class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Are you sure you want to delete this Category?</h3>
                    <div class="m-t-20">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

                        <form id="delete-form" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="cursor:pointer;">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" style="pointer-events: none;">
            <div class="modal-content" style="background: transparent; border: none; box-shadow: none; pointer-events: auto;">
                <div class="d-flex justify-content-center align-items-center" style="height: 10rem;">
                    <div class="spinner-border text-primary" role="status" style="width: 5rem; height: 5rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        $(document).ready(function() {

            // Open delete modal and set form action dynamically
            $('#delete_product').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget); // Button that triggered the modal
                let productId = button.data('id'); // Get product ID from data-id
                let actionUrl = `/dashboard/product/${productId}`; // Your route for delete
                $('#delete-form').attr('action', actionUrl);
            });

            // Show loading modal on delete submit
            $('#delete-form').on('submit', function() {
                $('#delete_product').modal('hide');
                $('#loadingModal').modal('show');
            });

            // Show loading on Edit
            $('.category-edit-btn').on('click', function() {
                $('#loadingModal').modal('show');
            });

            // Auto-hide success alert
            setTimeout(() => {
                $('#success-alert').alert('close');
            }, 3000);

        });
    </script>
</body>

</html>