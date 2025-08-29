<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    @include('front-end.components.nav')

    <div class="container py-5">
        <h1 class="mb-4">Your Shopping Cart</h1>

        @if (isset($cart) && count($cart) > 0)
        <div class="row g-4">

            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-end">Total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $subtotal = 0; @endphp
                                    @foreach ($cart as $id => $item)
                                    @php
                                    $discount = $item['discount'] ?? 0;
                                    $originalPrice = $item['original_price'] ?? $item['price'];
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $subtotal += $itemTotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded me-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $item['name'] }}">
                                                <div>
                                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($discount > 0)
                                            <del class="text-muted">${{ number_format($originalPrice, 2) }}</del><br>
                                            @endif
                                            <span class="fw-semibold">${{ number_format($item['price'], 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $discount > 0 ? 'warning' : 'secondary' }} text-white">
                                                {{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}% OFF
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span>{{ $item['quantity'] }}</span>
                                        </td>
                                        <td class="text-end fw-bold">
                                            ${{ number_format($itemTotal, 2) }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove item">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Subtotal
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 fw-bold border-top pt-3">
                                Total
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary w-100 mt-4">Proceed to Checkout</a>
                        <a href="/" class="btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>

        </div>
        @else
        <!-- Empty Cart -->
        <div class="text-center py-5">
            <div class="card border-0 shadow-sm p-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                <h2>Your cart is empty.</h2>
                <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                <div class="mt-4">
                    <a href="/" class="btn btn-primary">Start Shopping</a>
                </div>
            </div>
        </div>
        @endif
    </div>

    @include('front-end.components.footer')

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>