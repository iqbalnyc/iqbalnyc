<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient-info">
        <div class="container px-4 px-lg-5">
            <a href="/" class="text-decoration-none">
                <span class="h4 text-uppercase text-primary bg-info px-1">Multi</span>
                <span class="h4 text-uppercase text-info bg-primary px-1 ml-n1">Shop</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="/" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <form>
                        <input type="text" name="search" placeholder="Search Product ..."  class="form-control w-300">
                    </form>
                    </li>
                </ul>
               
                <i class="bi-cart-fill me-1"></i>
                Cart
                <a href="/product/cart"><span class="btn btn-outline-dark badge bg-info text-white ms-1 rounded-pill">{{ $countCart }}</span></a>
            </div>
            <!--  Login Toggle -->
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>

                    <div class="dropdown-menu dropdown-menu-right text-center">
                        @if(session('userEmail'))
                        <span class="text-info">Hi, {{ session('userName') }}</span>
                        <a class="dropdown-item" href="/customer/logout">Logout</a>
                        <a class="dropdown-item" href="/customer/dashboard">Dashboard</a>
                        @else
                        <span class="text-info">Hi, Geust</span>
                        <a class="dropdown-item" href="/customer/login">Sign in</a>
                        <a class="dropdown-item" href="/admin/registration">Registration</a>
                        @endif
                    </div>
                </div>
            </div>
            <!--  Login Toggle -->
        </div>
    </nav>

    <!-- header -->
    @yield('components.header')

    <!-- Section-->
    @yield('content')

    <!-- Footer-->
    @yield('components.footer')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>