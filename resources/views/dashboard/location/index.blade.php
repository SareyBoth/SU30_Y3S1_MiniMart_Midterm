<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>PrimeMart - Locations</title>

    <!--Style-->
    @include('dashboard.components.style')

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
                        <h4 class="page-title">Locations</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('dashboard.location.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Location</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Link</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop through the locations collection --}}
                                    @foreach ( $locations as $location)
                                    <tr>
                                        <td><img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" style="width: 100px; height: 100px; object-fit: cover;"></td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->address }}</td>
                                        <td><a href="{{ $location->link }}" target="_blank">View Link</a></td>
                                        <td class="text-center">
                                            <!-- Edit Icon -->
                                            <a href="{{ route('dashboard.location.edit', $location->id) }}" title="Edit">
                                                <i class="fa fa-file-pen mr-2" style="color: #007bff; font-size: 16px; margin-right: 8px;"></i>
                                            </a>

                                            <!-- Delete Icon -->
                                            <a href="#" data-toggle="modal" data-target="#delete_location" title="Delete" data-id="{{ $location->id }}">
                                                <i class="fa fa-trash" style="color: #dc3545; font-size: 16px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-container mt-5 mb-5 d-flex justify-content-end">
                                {{-- Render pagination links for the locations --}}
                                {{ $locations->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete_location" class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Are you sure you want to delete this location?</h3>
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
            $('#delete_location').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget); // Button that triggered the modal
                let locationId = button.data('id'); // Get location ID from data-id
                let actionUrl = `/dashboard/location/${locationId}`; // Your route for delete
                $('#delete-form').attr('action', actionUrl);
            });

            // Show loading modal on delete submit
            $('#delete-form').on('submit', function() {
                $('#delete_location').modal('hide');
                $('#loadingModal').modal('show');
            });

            // Show loading on Edit
            $('.location-edit-btn').on('click', function() {
                $('#loadingModal').modal('show');
            });

            // Auto-hide success alert after 3 seconds
            setTimeout(() => {
                $('#success-alert').alert('close');
            }, 3000);

        });
    </script>
</body>

</html>