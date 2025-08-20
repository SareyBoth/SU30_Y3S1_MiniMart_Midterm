<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>PrimeMart</title>

    <!--Style-->
    @include('dashboard.components.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>

                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="fa fa-dashboard"></i><span>Dashboard</span>
                        </a>
                    </li>

                    {{-- The parent `li` is active if either child page is active --}}
                    <li class="submenu {{ request()->is('dashboard/category*') || request()->is('dashboard/sub-category*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-list"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            {{-- The child link also gets an active class --}}
                            <li><a class="{{ request()->is('dashboard/category*') ? 'active' : '' }}" href="/dashboard/category">Category</a></li>
                            <li><a class="{{ request()->is('dashboard/sub-category*') ? 'active' : '' }}" href="/dashboard/sub-category">Sub Category</a></li>
                        </ul>
                    </li>

                    {{-- The asterisk (*) keeps the link active on pages like /product/create or /product/1/edit --}}
                    <li class="{{ request()->is('dashboard/product*') ? 'active' : '' }}">
                        <a href="/dashboard/product">
                            <i class="fa fa-table"></i> <span>Product</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('dashboard/order*') ? 'active' : '' }}">
                        <a href="/dashboard/order"><i class="fa-solid fa-bag-shopping"></i> <span>Order</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/payment*') ? 'active' : '' }}">
                        <a href="/dashboard/payment"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
                    </li>
                    <!-- 
                    <li class="{{ request()->is('dashboard/coupon*') ? 'active' : '' }}">
                        <a href="/dashboard/coupon"><i class="fa-solid fa-receipt"></i> <span>Discount</span></a>
                    </li> -->

                    <li class="submenu {{ request()->is(['dashboard/coupons*', 'dashboard/discount-category*', 'dashboard/discount-product*']) ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-receipt"></i> <span> Discounts </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li>
                                <a class="{{ request()->is('dashboard/coupon*') ? 'active' : '' }}" href="/dashboard/coupon">Coupon</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('dashboard/discount/category*') ? 'active' : '' }}" href="/dashboard/discount-category">Discount Category</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('dashboard/discount-sub-category*') ? 'active' : '' }}" href="/dashboard/discount-category">Discount Sub Category</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('dashboard/discount-product*') ? 'active' : '' }}" href="/dashboard/discount-product">Discount Product</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('dashboard/blog*') ? 'active' : '' }}"> {{-- Assuming this path --}}
                        <a href="/dashboard/blog"><i class="fa fa-commenting-o"></i> <span>Blog</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/location*') ? 'active' : '' }}">
                        <a href="/dashboard/location"><i class="fa-solid fa-location-dot"></i> <span>Location</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/media*') ? 'active' : '' }}">
                        <a href="/dashboard/media"><i class="fa-solid fa-bullhorn"></i><span>Media</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/user*') ? 'active' : '' }}">
                        <a href="/dashboard/user"><i class="fa-solid fa-user"></i><span>User</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/authentication*') ? 'active' : '' }}">
                        <a href="/dashboard/authentication"><i class="fa-solid fa-key"></i> <span>Authentication</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/setting*') ? 'active' : '' }}">
                        <a href="/dashboard/setting"><i class="fa-solid fa-gear"></i> <span>Setting</span></a>
                    </li>

                    <li class="{{ request()->is('dashboard/contact-us*') ? 'active' : '' }}">
                        <a href="/dashboard/contact-us"><i class="fa-solid fa-address-book"></i><span>Contact Us</span></a>
                    </li>
                    {{-- I removed one extra closing </li> tag here that was a syntax error --}}
                </ul>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js')}}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/dashboard/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('js/dashboard/select2.min.js')}}"></script>
    <script src="{{ asset('js/dashboard/app.js')}}"></script>
</body>

</html>