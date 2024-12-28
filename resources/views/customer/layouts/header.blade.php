<!-- Navbar Start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3">
                    <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                    <a href="#" class="text-white">Jl. Teuku Umar No.15</a>
                </small>
                <small class="me-3">
                    <i class="fas fa-envelope me-2 text-secondary"></i>
                    <a href="#" class="text-white">fruitStation@gmail.com</a>
                </small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ Auth::check() && Auth::user()->role == 'customer' ? '/customer/home' : '/home' }}" class="navbar-brand">
                <h1 class="text-primary display-6">FruitStation</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <!-- Home Link -->
                    <a href="{{ Auth::check() && Auth::user()->role == 'customer' ? '/customer/home' : '/home' }}" class="nav-item nav-link {{ Request::is('home') || Request::is('customer/home') ? 'active' : '' }}">Home</a>
                    <!-- Shop Link -->
                    <a href="/shop" class="nav-item nav-link {{ Request::is('shop') ? 'active' : '' }}">Shop</a>
                    <!-- Contact Link -->
                    <a href="/contact" class="nav-item nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact</a>

                    @if (Auth::check() && Auth::user()->role == 'customer')
                        <!-- Riwayat Belanja Link -->
                        <a href="{{ route('riwayat.belanja') }}" class="nav-item nav-link {{ Route::is('riwayat.belanja') ? 'active' : '' }}">Riwayat Belanja</a>
                    @endif
                </div>

                <div class="d-flex m-3 me-0 align-items-center">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('search') }}">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <input type="hidden" name="role" value="customer">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" style="background-color: #4CAF50; border-color: #4CAF50;">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <li class="onhover-dropdown wislist-dropdown ms-4">
                        <div class="cart-media">
                            <a href="/cart" class="d-flex align-items-center">
                                <i data-feather="shopping-cart" class="fa fa-shopping-bag fa-2x" style="color: hsl(122, 39%, 49%);"></i>
                                <span id="cart-count" class="label label-theme rounded-pill ms-1">
                                    {{-- {{ Cart::content()->count() }} --}}
                                </span>
                            </a>
                        </div>
                    </li>

                    <a href="/login" class="my-auto ms-4">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </div>

                <div class="d-flex align-items-center">
                    @if (Auth::check())
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                Welcome, {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="nav-item nav-link"></a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
