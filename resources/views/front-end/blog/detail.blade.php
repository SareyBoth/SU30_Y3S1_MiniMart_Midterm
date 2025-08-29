<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prime Mart</title>
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

    <img src="/storage/{{ $blog->image }}" style="height:600px;" class="img-fluid w-100" alt="Blog Cover">

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row g-5">

            <!-- Blog Post Content -->
            <main class="col-lg-12 blog-content">
                <div>{!! $blog->body !!}</div>
            </main>
        </div>
    </div>

    <!-- More From The Blog Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="fw-bold text-dark mb-4 text-center">More From The Blog</h2>
            <div class="row g-4">
                @foreach ( $blogs as $item )
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 h-100">
                            <img class="card-img-top" src="/storage/{{ $item->image }}" alt="Blog Post Image">
                            <div class="card-body">
                                <p class="small text-danger fw-semibold truncate-1">{{ $item->title }}</p>
                                <h5 class="fw-bold"><a href="#" class="text-dark text-decoration-none truncate-1">{{ $item->meta_description }}</a></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('front-end.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
<style>
    /* Custom font styles */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Lora', serif;
    }

    .blog-cover {
        height: 60vh;
        background-size: cover;
        background-position: center;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .truncate-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

</html>