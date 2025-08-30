<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $product->name ?? 'Product Details' }} - PrimeMart</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $product->description ?? 'High-quality grocery products at PrimeMart.' }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Include your standard navigation bar --}}
    @include('front-end.components.nav')

    <section class="py-5">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-6">
                    <!-- Main Product Image -->
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm w-100" style="height: 450px; object-fit: cover;" id="mainProductImage">
                    </div>
                    <!-- Thumbnail Images (Optional) -->
                    {{-- You can add more images to your product model and loop through them here --}}
                    <div class="d-flex justify-content-start gap-2">
                        {{-- <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" width="80" style="cursor: pointer;"> --}}
                        {{-- <img src="{{ asset('storage/' . $product->gallery_image_2) }}" class="img-thumbnail" width="80" style="cursor: pointer;"> --}}
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Product Details -->
                    <h1 class="display-5 fw-bold">{{ $product->name }}</h1>

                    <!-- Pricing -->
                    @php
                        $discount = $product->discountRelation?->discount_value;
                        $original_price = $product->original_price ?? $product->price;
                    @endphp
                    <div class="fs-4 mb-3">
                        @if($discount)
                            <del class="text-muted me-2">${{ number_format($original_price, 2) }}</del>
                            <span class="fw-bold text-danger">${{ number_format($product->price, 2) }}</span>
                            <span class="badge bg-danger ms-2">{{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}% OFF</span>
                        @else
                            <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <p class="mb-3">
                        <span class="fw-bold">Availability:</span>
                        <span class="badge {{ $product->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out Of Stock' }}
                        </span>
                    </p>

                    <!-- Short Description -->
                    <p class="lead">{{ $product->description ?? 'No description available for this product.' }}</p>

                    <!-- Add to Cart Form -->
                    <div class="mt-4">
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock_quantity }}">
                                    </div>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary w-100 py-2" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <a href="/login" class="btn btn-primary w-100 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i> Login to Purchase
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Full Description / Reviews Tabs -->
            <div class="mt-5">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews (0)</button>
                    </li>
                </ul>
                <div class="tab-content card p-4" id="productTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <p>{{ $product->long_description ?? $product->description ?? 'Detailed description not available.' }}</p>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <p>There are no reviews yet for this product.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Related Products Section -->
    <section class="py-5 bg-light">
        <div class="container-lg">
            <h2 class="text-center mb-4">Related Products</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($relatedProducts as $relatedProduct)
                <div class="col">
                    <div class="product-item h-100 d-flex flex-column card p-2">
                        <figure>
                            <a href="{{ route('product.show', $relatedProduct->id) }}" title="{{ $relatedProduct->name }}">
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="tab-image">
                            </a>
                        </figure>
                        <div class="d-flex flex-column text-center flex-grow-1">
                            <h3 class="fs-6 fw-normal">{{ $relatedProduct->name }}</h3>
                            <div class="mt-auto">
                                <span class="text-dark fw-semibold">${{ number_format($relatedProduct->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Include your standard footer --}}
    @include('front-end.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
