<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart - PrimeMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    @include('front-end.components.nav')

    <div class="container py-5">
        <h2 class="mb-4">Your Shopping Cart</h2>

        {{-- THIS NEW SECTION WILL DISPLAY ERROR MESSAGES --}}
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row g-4">
            @if (count($cart) > 0)
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 15%;">Product</th>
                                            <th scope="col" style="width: 35%;"></th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $subtotal = 0; @endphp
                                        @foreach ($cart as $id => $item)
                                            @php $subtotal += $item['price'] * $item['quantity']; @endphp
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded" alt="{{ $item['name'] }}">
                                                </td>
                                                <td>
                                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                </td>
                                                <td>${{ number_format($item['price'], 2) }}</td>
                                                <td>
                                                    <input type="number" class="form-control" value="{{ $item['quantity'] }}" style="width: 70px;" readonly>
                                                </td>
                                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
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

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>

                            <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    Proceed to Checkout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 text-center">
                    <div class="card border-0 shadow-sm p-5">
                        <div class="card-body">
                            <h4 class="card-title">Your cart is empty.</h4>
                            <p class="card-text">Looks like you haven't added anything to your cart yet.</p>
                            <a href="/" class="btn btn-primary mt-3">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('front-end.components.footer') 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

