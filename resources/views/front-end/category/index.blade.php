<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products in {{ $category->name ?? 'Category' }} - PrimeMart</title>
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

    {{-- Include your standard navigation bar --}}
    @include('front-end.components.nav')

    <section class="py-5">
        <div class="container-lg">

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
                                    <a href="/category/{{ $category->id }}" class="nav-link swiper-slide text-center">
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

            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold">Products in {{ $page->name }} </h1>
            </div>



            <div class="row">
                <div class="col-md-12">

                    @if($products->count() > 0)
                    <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">

                        @foreach ($products as $product)
                        <div class="col">
                            <div class="product-item h-100 d-flex flex-column">
                                <figure>
                                    <a href="/product/{{ $product->id }}" title="{{ $product->name }}">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="tab-image">
                                    </a>
                                </figure>
                                <div class="d-flex flex-column text-center flex-grow-1">
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
                                    <div class="button-area p-3 pt-0 mt-auto">
                                        @auth
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="row g-1 mt-2">
                                                <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" min="1"></div>
                                                <div class="col-7">
                                                    <button type="submit" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100">
                                                        <i class="fas fa-shopping-cart me-1"></i> Add
                                                    </button>
                                                </div>
                                                <div class="col-2"><a href="#" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                            </div>
                                        </form>
                                        @else
                                        <div class="row g-1 mt-2">
                                            <div class="col-3"><input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1" disabled></div>
                                            <div class="col-7"><a href="/login" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart w-100"><i class="fas fa-shopping-cart me-1"></i> Add</a></div>
                                            <div class="col-2"><a href="/login" class="btn btn-outline-dark rounded-1 p-2 fs-6"><i class="fas fa-heart"></i></a></div>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- Pagination Links -->
                    <div class="pagination-container mt-5 mb-5 d-flex justify-content-end">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>

                    @else
                    <div class="text-center py-5">
                        <p class="lead">No products found in this category.</p>
                        <a href="/" class="btn btn-primary mt-3">Back to Homepage</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

    {{-- Include your standard footer --}}
    @include('front-end.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>