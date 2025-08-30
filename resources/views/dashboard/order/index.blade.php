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
                        <h4 class="page-title">Order</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Shipping Address</th>
                                        <th class="text-center">Payment Status</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    @php
                                    $user = $order->user;
                                    @endphp
                                    <tr>
                                        <td>{{ $user->name ? $user->name : 'N/A' }}</td>
                                        <td class="text-center">{{ $order->order_id }}</td>
                                        <td class="text-center">{{ $order->shipping_address }}</td>
                                        <td class="text-center">{{ $order->payment_status }}</td>
                                        <td class="text-center">{{ $order->status }}</td>
                                        <td class="text-center">{{ $order->total_amount }}$</td>
                                        <td class="text-center">
                                            <a href="{{ route('dashboard.order.detail', $order->id) }}" title="Detail">
                                                <i class="fa-solid fa-magnifying-glass" style="color: #007bff; font-size: 16px; margin-right: 8px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="pagination-container mt-5 mb-5 d-flex justify-content-end">
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="sidebar-overlay" data-reff=""></div>
</body>

</html>