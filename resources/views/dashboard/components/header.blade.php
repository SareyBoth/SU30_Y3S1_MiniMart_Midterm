<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>PrimeMart</title>

    <!--Style-->
    @include('dashboard.components.style')

</head>

<body>
    <div class="header">
        <div class="header-left">
            <a href="/" class="logo">
                <span><img src="{{ asset('/images/dashboard/favicon-white.png') }}" width="200" height="40" alt=""></span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="{{ asset('/images/dashboard/user.jpg') }}" width="24" alt="Admin">
                        <span class="status online"></span>
                    </span>
                    <span>
                        @auth
                        {{ Auth::user()->name }}
                        @endauth
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </form>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js')}}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/dashboard/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('js/dashboard/Chart.bundle.js')}}"></script>
    <script src="{{ asset('js/dashboard/chart.js')}}"></script>
    <script src="{{ asset('js/dashboard/select2.min.js')}}"></script>
    <script src="{{ asset('js/dashboard/app.js')}}"></script>
</body>

</html>