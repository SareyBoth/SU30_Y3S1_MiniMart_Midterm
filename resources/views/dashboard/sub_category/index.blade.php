<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>PrimeMart</title>
    @include('dashboard.components.style')
</head>

<body>
    <div class="main-wrapper">
        @include('dashboard.components.header')
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
                        <h4 class="page-title">Sub Category</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('dashboard.sub_category.create') }}" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-plus"></i> Add Sub Category
                        </a>
                    </div>
                </div>

                <div class="row">
                    @foreach ($sub_categories as $sub_category)
                    <div class="col-md-4 col-sm-4 col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar">
                                    <img alt="" src="/storage/{{ $sub_category->image }}" />
                                </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('dashboard.sub_category.edit', $sub_category->id) }}">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#deleteModal"
                                        data-url="{{ route('dashboard.sub_category.destroy', $sub_category->id) }}">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a>{{ $sub_category->name }}</a></h4>
                            @php
                            $statusName = $sub_category->statusRelation ? $sub_category->statusRelation->name : 'No Status';
                            $categoryName = $sub_category->categoryRelation ? $sub_category->categoryRelation->name : 'No Category';
                            $statusStyle = strtolower($statusName) === 'active' ? 'color:green;' : (strtolower($statusName) === 'inactive' ? 'color:red;' : '');
                            @endphp
                            <p class="text-4" style="{{ $statusStyle }}">{{ $statusName }}</p>
                            <div class="user-country">{{ $categoryName }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination-container mt-5 mb-5 d-flex justify-content-end">
                    {{ $sub_categories->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Are you sure you want to delete this Sub Category?</h3>
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
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {

            // Use the exact route from data-url
            $('#deleteModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let actionUrl = button.data('url');
                $('#delete-form').attr('action', actionUrl);
            });

            // Show loading modal on form submit
            $('#delete-form').on('submit', function() {
                $('#deleteModal').modal('hide');
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