<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>PrimeMart</title>

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
                        <h4 class="page-title">Category</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="/dashboard/category/create" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-plus"></i> Add Category
                        </a>
                    </div>
                </div>

                <div class="row doctor-grid">
                    @foreach ($categories as $category)
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="profile-widget">
                                <div class="doctor-img">
                                    <a class="avatar" href="profile.html">
                                        <img alt="" src="assets/img/doctor-thumb-03.jpg" />
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
                                            data-id="{{ $category->id }}"
                                        >
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                        </a>
                                    </div>
                                </div>
                                <h4 class="doctor-name text-ellipsis"><a href="profile.html">{{ $category->name }}</a></h4>
                                <div class="doc-prof">{{ $category->status }}</div>
                                <div class="user-country">{{ $category->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="delete_doctor" class="modal fade delete-modal" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46" />
                        <h3>Are you sure you want to delete this Category?</h3>
                        <div class="m-t-20">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="delete-team-form" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>

    </div>

    <div class="sidebar-overlay" data-reff=""></div>

    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/dashboard/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/chart.js') }}"></script>
    <script src="{{ asset('js/dashboard/app.js') }}"></script>

    <script>
        $('#delete_doctor').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); 
            var categoryId = button.data('id');
            
            var action = `/dashboard/category/${categoryId}`;
            
            $('#delete-team-form').attr('action', action);
        
            $('#confirm-delete-btn').off('click').on('click', function () {
                $('#delete-team-form').submit();
            });
        });
    </script>
</body>

</html>
