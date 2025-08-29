<!DOCTYPE html>
<html lang="en">

<head>
    <title>PrimeMart</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>

    @include('front-end.components.nav')

    <div class="container py-5">

        <div class="row">
            <!-- Main Content -->
            <main class="col-lg-12">
                <h2 class="fw-bold mb-4">Latest Posts</h2>

                <!-- Post Card Row -->
                <div class="row g-4">
                    @foreach ( $blogs as $blog)
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100">
                            <a href="/blog/detail/{{ $blog->id }}"> <img src="/storage/{{ $blog->image }}" class="card-img-top"></a>
                            <div class="card-body">
                                <h3 class="h5 fw-bold mt-2 mb-3">
                                    <a href="/blog/detail{{ $blog->id }}" class="text-decoration-none text-dark">{{ $blog->title }}</a>
                                </h3>
                                <p class="text-muted truncate-2">{!! $blog->meta_description !!}</p>
                                <div class="text-muted small">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $blog->published_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>

    @include('front-end.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
<style>
    .truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

</html>