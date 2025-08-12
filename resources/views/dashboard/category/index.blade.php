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

                {{-- Success Message --}}
                @if(session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Category</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-plus"></i> Add Category
                        </a>
                    </div>
                </div>

                <div class="row doctor-grid">
                    @foreach ($categories as $category)
                    <div class="col-md-4 col-sm-4 col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar">
                                    <img alt="" src="/storage/{{ $category->image }}" />
                                </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('dashboard.category.edit', $category->id) }}">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#delete_doctor"
                                        data-id="{{ $category->id }}">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a>{{ $category->name }}</a></h4>

                            @php
                            $statusName = $category->statusRelation ? $category->statusRelation->name : 'No Status';
                            $statusStyle = '';
                            if (strtolower($statusName) === 'active') {
                            $statusStyle = 'color: green;';
                            } elseif (strtolower($statusName) === 'inactive') {
                            $statusStyle = 'color: red;';
                            }
                            @endphp

                            <p class="text-4" style="{{ $statusStyle }}">
                                {{ $statusName }}
                            </p>
                            <div class="text-gray-700 text-sm leading-relaxed text-ellipsis">
                                {{ $category->description }}
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete_doctor" class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
        // Set delete form action dynamically when modal opens
        $('#delete_doctor').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered modal
            var categoryId = button.data('id'); // Get category ID

            var actionUrl = `/dashboard/category/${categoryId}`;

            $('#delete-form').attr('action', actionUrl);
        });

        // Show loading modal on form submit
        $('#delete-form').on('submit', function() {
            // Hide confirmation modal
            $('#delete_doctor').modal('hide');

            // Show loading modal
            $('#loadingModal').modal('show');
        });

        // Auto-hide success alert after 3 seconds
        setTimeout(() => {
            let alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
            }
        }, 3000);
    </script>
</body>

</html>