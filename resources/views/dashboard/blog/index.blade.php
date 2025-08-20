<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <title>PrimeMart</title>

    @include('dashboard.components.style')

    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
</head>

<body>
    <div class="main-wrapper">

        @include('dashboard.components.header')

        @include('dashboard.components.sidebar')

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-4">
                        <h4 class="page-title">Blog</h4>
                    </div>
                    <div class="col-sm-4 col-8 text-right m-b-30">
                        <a class="btn btn-primary btn-rounded float-right" href="{{ route('dashboard.blog.create') }}"><i class="fa fa-plus"></i> Add Blog</a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($blogs as $blog)
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="{{ url('blog-details', ['slug' => $blog->slug]) }}"><img class="img-fluid" src="/storage/{{ $blog->image }}" alt=""></a>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="{{ url('blog-details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a></h3>
                                <p class=" line-clamp-2">{{ $blog->excerpt }}</p>
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-calendar"></i> <span>{{ $blog->published_at->format('F d, Y') }}</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="post-right">
                                        <a href="{{ route('dashboard.blog.edit', $blog->id) }}"><i class="fa fa-file-pen" style="color: #007bff;"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#delete_product" data-blog-id="{{ $blog->id }}" class="delete-link"><i class="fa fa-trash" style="color: #dc3545; font-size: 16px;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="delete_product" class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Are you sure you want to delete this blog post?</h3>
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

    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        $(document).ready(function() {
            // JavaScript for the delete modal
            $('#delete_product').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var blogId = button.data('blog-id');
                var form = $('#delete-form');
                form.attr('action', '/dashboard/blog/' + blogId);
            });
        });
    </script>
</body>

</html>