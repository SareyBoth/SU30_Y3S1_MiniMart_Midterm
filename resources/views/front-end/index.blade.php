<!DOCTYPE html>
<html lang="en">

<head>
    <title>Organic - Grocery Store HTML Website Template</title>
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

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/meat-poster.png" class="d-block w-100" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="/images/snack-poster.png" class="d-block w-100" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="/images/bread-poster.png" class="d-block w-100" alt="Third slide">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <section class="py-5 overflow-hidden">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                        <h2 class="section-title">Category</h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary me-2">View All</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                                <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="category-carousel swiper">
                        <div class="swiper-wrapper">
                            @foreach ($categories as $category )
                            <a href="category.html" class="nav-link swiper-slide text-center">
                                <img src="/storage/{{ $category->image }}" class="rounded-circle " style=" width: 160px; height: 160px;" alt="Category Thumbnail">
                                <h4 class="fs-6 mt-3 fw-normal category-title">{{ $category->name }}</h4>
                            </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container-lg">

            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between my-4">

                        <h2 class="section-title">Best selling products</h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary rounded-1">View All</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">

                        @foreach ($best_sell_product as $product )
                        <div class="col">
                            <div class="product-item">
                                <figure>
                                    <a href="/product/{{ $product->id }}" title="Product Title">
                                        <img src="/storage/{{ $product->image }}" alt="Product Thumbnail" class="tab-image">
                                    </a>
                                </figure>
                                <div class="d-flex flex-column text-center">
                                    <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
                                    <h5 class="fs-6 fw-normal {{ $product->stock_quantity <= 5 ? 'text-danger' : 'text-success' }}">
                                        {{ $product->stock_quantity <= 5 ? 'Out Of Stock' : 'In Stock' }}
                                    </h5>
                                    @php
                                    $discount = $product->discountRelation?->discount_value;
                                    $original_price = $product->original_price ?? $product->price; // Fallback if original_price is not set
                                    @endphp
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        @if($discount)
                                        <del>${{ number_format($original_price, 2) }}</del>
                                        @endif
                                        <span class="text-dark fw-semibold">${{ number_format($product->price, 2) }}</span>
                                        @if ($discount)
                                        <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
                                            {{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}% OFF
                                        </span>
                                        @endif
                                    </div>
                                    <div class="button-area p-3 pt-0">
                                        @auth
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="row g-1 mt-2">
                                                <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" min="1"></div>
                                                <div class="col-7">
                                                    <button type="submit" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100">
                                                        <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                                    </button>
                                                </div>
                                                <div class="col-2"><a href="#" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                            </div>
                                        </form>
                                        @else
                                        <div class="row g-1 mt-2">
                                            <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" disabled></div>
                                            <div class="col-7"><a href="/login" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100"><i class="fas fa-shopping-cart me-1"></i> Add to Cart</a></div>
                                            <div class="col-2"><a href="/login" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- / product-grid -->

                </div>
            </div>
        </div>
    </section>

    <div class="py-3">
        <div class="container-lg">
            <div class="container-lg">
                <img src="{{ asset('images/meat-poster.png') }}" alt="Meat Poster" style="width: 100%; height: auto; display: block; object-fit: cover;" />
                <div class="row mt-3">
                    <div class="col-md-12">

                        <div class="section-header d-flex flex-wrap justify-content-between my-4">
                            <h2 class="section-title">Butchery products</h2>
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-primary rounded-1">View All</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">

                            @foreach ($butchery_product as $product )
                            <div class="col">
                                <div class="product-item">
                                    <figure>
                                        <a href="/product/{{ $product->id }}" title="Product Title">
                                            <img src="/storage/{{ $product->image }}" alt="Product Thumbnail" class="tab-image">
                                        </a>
                                    </figure>
                                    <div class="d-flex flex-column text-center">
                                        <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
                                        <h5 class="fs-6 fw-normal {{ $product->stock_quantity <= 5 ? 'text-danger' : 'text-success' }}">
                                            {{ $product->stock_quantity <= 5 ? 'Out Of Stock' : 'In Stock' }}
                                        </h5>
                                        @php
                                        $discount = $product->discountRelation?->discount_value;
                                        $original_price = $product->original_price ?? $product->price;
                                        @endphp
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            @if($discount)
                                            <del>${{ number_format($original_price, 2) }}</del>
                                            @endif
                                            <span class="text-dark fw-semibold">${{ number_format($product->price, 2) }}</span>
                                            @if ($discount)
                                            <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
                                                {{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}% OFF
                                            </span>
                                            @endif
                                        </div>
                                        <div class="button-area p-3 pt-0">
                                            @auth
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="row g-1 mt-2">
                                                    <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" min="1"></div>
                                                    <div class="col-7">
                                                        <button type="submit" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100">
                                                            <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                                        </button>
                                                    </div>
                                                    <div class="col-2"><a href="#" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                                </div>
                                            </form>
                                            @else
                                            <div class="row g-1 mt-2">
                                                <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" disabled></div>
                                                <div class="col-7"><a href="/login" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100"><i class="fas fa-shopping-cart me-1"></i> Add to Cart</a></div>
                                                <div class="col-2"><a href="/login" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                            </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container-lg">
                    <img src="{{ asset('images/bread-poster.png') }}" alt="Bread Poster" style="width: 100%; height: auto; display: block; object-fit: cover;" />
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="section-header d-flex flex-wrap justify-content-between my-4">
                                <h2 class="section-title">Bakery products</h2>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-primary rounded-1">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                                @foreach ($bakery_product as $product )
                                <div class="col">
                                    <div class="product-item">
                                        <figure>
                                            <a href="/product/{{ $product->id }}" title="Product Title">
                                                <img src="/storage/{{ $product->image }}" alt="Product Thumbnail" class="tab-image">
                                            </a>
                                        </figure>
                                        <div class="d-flex flex-column text-center">
                                            <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
                                            <h5 class="fs-6 fw-normal {{ $product->stock_quantity <= 5 ? 'text-danger' : 'text-success' }}">
                                                {{ $product->stock_quantity <= 5 ? 'Out Of Stock' : 'In Stock' }}
                                            </h5>
                                            @php
                                            $discount = $product->discountRelation?->discount_value;
                                            $original_price = $product->original_price ?? $product->price;
                                            @endphp
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                @if($discount)
                                                <del>${{ number_format($original_price, 2) }}</del>
                                                @endif
                                                <span class="text-dark fw-semibold">${{ number_format($product->price, 2) }}</span>
                                                @if ($discount)
                                                <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
                                                    {{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}% OFF
                                                </span>
                                                @endif
                                            </div>
                                            <div class="button-area p-3 pt-0">
                                                @auth
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="row g-1 mt-2">
                                                        <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" min="1"></div>
                                                        <div class="col-7">
                                                            <button type="submit" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100">
                                                                <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                                            </button>
                                                        </div>
                                                        <div class="col-2"><a href="#" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                                    </div>
                                                </form>
                                                @else
                                                <div class="row g-1 mt-2">
                                                    <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" disabled></div>
                                                    <div class="col-7"><a href="/login" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100"><i class="fas fa-shopping-cart me-1"></i> Add to Cart</a></div>
                                                    <div class="col-2"><a href="/login" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                                </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-lg">
                    <img src="{{ asset('images/snack-poster.png') }}" alt="Snack Poster" style="width: 100%; height: auto; display: block; object-fit: cover;" />
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="section-header d-flex flex-wrap justify-content-between my-4">
                                <h2 class="section-title">Snack products</h2>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-primary rounded-1">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                                @foreach ($snack_product as $product )
                                <div class="col">
                                    <div class="product-item">
                                        <figure>
                                            <a href="/product/{{ $product->id }}" title="Product Title">
                                                <img src="/storage/{{ $product->image }}" alt="Product Thumbnail" class="tab-image">
                                            </a>
                                        </figure>
                                        <div class="d-flex flex-column text-center">
                                            <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
                                            <h5 class="fs-6 fw-normal {{ $product->stock_quantity <= 5 ? 'text-danger' : 'text-success' }}">
                                                {{ $product->stock_quantity <= 5 ? 'Out Of Stock' : 'In Stock' }}
                                            </h5>
                                            @php
                                            $discount = $product->discountRelation?->discount_value;
                                            $original_price = $product->original_price ?? $product->price;
                                            @endphp
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                @if($discount)
                                                <del>${{ number_format($original_price, 2) }}</del>
                                                @endif
                                                <span class="text-dark fw-semibold">${{ number_format($product->price, 2) }}</span>
                                                @if ($discount)
                                                <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
                                                    {{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}% OFF
                                                </span>
                                                @endif
                                            </div>
                                            <div class="button-area p-3 pt-0">
                                                @auth
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="row g-1 mt-2">
                                                        <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" min="1"></div>
                                                        <div class="col-7">
                                                            <button type="submit" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100">
                                                                <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                                            </button>
                                                        </div>
                                                        <div class="col-2"><a href="#" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                                    </div>
                                                </form>
                                                @else
                                                <div class="row g-1 mt-2">
                                                    <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" disabled></div>
                                                    <div class="col-7"><a href="/login" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100"><i class="fas fa-shopping-cart me-1"></i> Add to Cart</a></div>
                                                    <div class="col-2"><a href="/login" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                                </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container-lg">
            <div class="bg-secondary text-light py-5 my-5" style="background: url('{{ asset('images/banner-newsletter.jpg') }}') no-repeat; background-size: cover;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 p-3">
                            <div class="section-header">
                                <h2 class="section-title display-5 text-light">Get 25% Discount on your first purchase</h2>
                            </div>
                            <p>Just Sign Up & Register it now to become member.</p>
                        </div>
                        <div class="col-md-5 p-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="latest-blog" class="pb-4">
        <div class="container-lg">
            <div class="row">
                <div class="section-header d-flex align-items-center justify-content-between my-4">
                    <h2 class="section-title">Our Recent Blog</h2>
                    <a href="#" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <article class="post-item card border-0 shadow-sm p-3">
                        <div class="image-holder zoom-effect">
                            <a href="#">
                                <img src="{{ asset('images/post-thumbnail-1.jpg') }}" alt="post" class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                                <div class="meta-date"><i class="fas fa-calendar-alt me-1"></i>22 Aug 2021</div>
                                <div class="meta-categories"><i class="fas fa-folder me-1"></i>tips & tricks</div>
                            </div>
                            <div class="post-header">
                                <h3 class="post-title">
                                    <a href="#" class="text-decoration-none">Top 10 casual look ideas to dress up your kids</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="post-item card border-0 shadow-sm p-3">
                        <div class="image-holder zoom-effect">
                            <a href="#">
                                <img src="{{ asset('images/post-thumbnail-2.jpg') }}" alt="post" class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                                <div class="meta-date"><i class="fas fa-calendar-alt me-1"></i>25 Aug 2021</div>
                                <div class="meta-categories"><i class="fas fa-folder me-1"></i>trending</div>
                            </div>
                            <div class="post-header">
                                <h3 class="post-title">
                                    <a href="#" class="text-decoration-none">Latest trends of wearing street wears supremely</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="post-item card border-0 shadow-sm p-3">
                        <div class="image-holder zoom-effect">
                            <a href="#">
                                <img src="{{ asset('images/post-thumbnail-3.jpg') }}" alt="post" class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                                <div class="meta-date"><i class="fas fa-calendar-alt me-1"></i>28 Aug 2021</div>
                                <div class="meta-categories"><i class="fas fa-folder me-1"></i>inspiration</div>
                            </div>
                            <div class="post-header">
                                <h3 class="post-title">
                                    <a href="#" class="text-decoration-none">10 Different Types of comfortable clothes ideas for women</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <i class="fas fa-box-open fa-2x"></i>
                        </div>
                        <div class="card-body p-0">
                            <h5>Free delivery</h5>
                            <p class="card-text">Enjoy fast, reliable shipping at no extra cost on every order.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <div class="card-body p-0">
                            <h5>100% secure payment</h5>
                            <p class="card-text">Shop with confidence using encrypted.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div class="card-body p-0">
                            <h5>Quality guarantee</h5>
                            <p class="card-text">Every product is carefully selected quality promise.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                        <div class="card-body p-0">
                            <h5>Guaranteed savings</h5>
                            <p class="card-text">Get more exclusive deals that help you save every day.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <i class="fas fa-gift fa-2x"></i>
                        </div>
                        <div class="card-body p-0">
                            <h5>Daily offers</h5>
                            <p class="card-text">New discounts daily. Check back for fresh steals and surprises.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5">
        <div class="container-lg">
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-menu">
                        <img src="{{ asset('images/favicon.png') }}" width="240" height="70" alt="logo">
                        <div class="social-links mt-3">
                            <ul class="d-flex list-unstyled gap-2">
                                <li>
                                    <a href="#" class="btn btn-outline-light">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-light">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-light">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-light">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-light">
                                        <i class="fab fa-amazon"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6">
                    <div class="footer-menu">
                        <h5 class="widget-title">PrimeMart</h5>
                        <ul class="menu-list list-unstyled">
                            <li class="menu-item">
                                <a href="#" class="nav-link">About us</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Conditions </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Our Journals</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Careers</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Affiliate Programme</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Ultras Press</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="footer-menu">
                        <h5 class="widget-title">Quick Links</h5>
                        <ul class="menu-list list-unstyled">
                            <li class="menu-item">
                                <a href="#" class="nav-link">Offers</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Discount Coupons</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Stores</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Track Order</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Info</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="footer-menu">
                        <h5 class="widget-title">Customer Service</h5>
                        <ul class="menu-list list-unstyled">
                            <li class="menu-item">
                                <a href="#" class="nav-link">FAQ</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Contact</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Privacy Policy</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Returns & Refunds</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Cookie Guidelines</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="nav-link">Delivery Information</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-menu">
                        <h5 class="widget-title">Subscribe Us</h5>
                        <p>Subscribe to our newsletter to get updates about our grand offers.</p>
                        <form class="d-flex mt-3 gap-0" action="">
                            <input class="form-control rounded-start rounded-0 bg-light" type="email" placeholder="Email Address" aria-label="Email Address">
                            <button class="btn btn-dark rounded-end rounded-0" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <div id="footer-bottom">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p>© 2025 PrimeMart. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#carouselExampleIndicators').carousel();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>