<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <title>Order Detail - PrimeMart</title>

    <!-- Style -->
    @include('dashboard.components.style')

    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
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
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">Order Detail</h4>
                    </div>
                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="{{ route('dashboard.order.index') }}" class="btn btn-primary btn-rounded"><i class="fa fa-arrow-left"></i> Back to Orders</a>
                    </div>
                </div>
                <div class="card-box profile-header py-5">
                    <div class="row pb-3">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        {{-- Assuming user has a profile image --}}
                                        <a href="#"><img class="avatar" src="{{ asset('/storage/' . ($order->user->profile ?? 'profile/default_profile.jpg')) }}" alt="User Profile"></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $order->user->name ?? 'N/A' }}</h3>
                                                <div class="staff-id mb-2">Order ID: {{ $order->order_id }}</div>
                                                <div class="staff-id">Status: <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#">{{ $order->user->phone ?? 'N/A' }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#">{{ $order->user->email ?? 'N/A' }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Shipping Address:</span>
                                                    <span class="text">{{ $order->shipping_address }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#order-items-tab" data-toggle="tab">Order Items</a></li>
                        <li class="nav-item"><a class="nav-link" href="#address-tab" data-toggle="tab">Details</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="order-items-tab">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                        <tr>
                                            <td><img src="{{ asset('storage/' . $item->product->image) }}" width="50" height="50" alt="{{ $item->product->name }}"></td>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-right">${{ number_format($item->price, 2) }}</td>
                                            <td class="text-right">${{ number_format($item->quantity * $item->price, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end mt-4">
                                <div class="col-md-4">
                                    <div class="text-right">
                                        <h4>Total: <span class="font-weight-bold">${{ number_format($order->total_amount, 2) }}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="address-tab">
                            <h5 class="mb-3">Order Details</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Payment Method:</strong> {{ $order->payment_method }}</li>
                                <li class="list-group-item"><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</li>
                                <li class="list-group-item"><strong>Notes:</strong> {{ $order->notes ?? 'No notes provided.' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
</body>

</html>