<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo FruitStation.png') }}" alt="Fruit Station Logo" style="width: 50px; height: 50px;">
        </div>
        <div class="sidebar-brand-text mx-2">
            @if (Auth::user()->role === 'super_admin')
                Super Admin Fruit Station
            @elseif (Auth::user()->role === 'admin')
                Admin Fruit Station
            @elseif (Auth::user()->role === 'kurir')
                Kurir Fruit Station
            @else
                Fruit Station
            @endif
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Kategori Produk -->
    @if(Auth::user()->role === 'admin')
    <li class="nav-item {{ request()->is('kategori') ? 'active' : '' }}">
        <a class="nav-link" href="/kategori">
            <i class="fas fa-fw fa-th-list"></i>
            <span>Kategori Produk</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Produk -->
    @if(Auth::user()->role === 'admin')
    <li class="nav-item {{ request()->is('produk') ? 'active' : '' }}">
        <a class="nav-link" href="/produk">
            <i class="fas fa-fw fa-apple-alt"></i>
            <span>Produk</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Pesanan -->
    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'kurir')
    <li class="nav-item {{ request()->is('dashboard/pesanan*') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/pesanan">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Pembayaran -->
    @if(Auth::user()->role === 'admin')
    <li class="nav-item {{ request()->is('dashboard/pembayaran') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/pembayaran">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Pembayaran</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Promosi & Diskon -->
    @if(Auth::user()->role === 'admin')
    <li class="nav-item {{ request()->is('promosi') ? 'active' : '' }}">
        <a class="nav-link" href="/promosi">
            <i class="fas fa-fw fa-tags"></i>
            <span>Promosi & Diskon</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Pemasok -->
    @if(Auth::user()->role === 'admin')
    <li class="nav-item {{ request()->is('dashboard/pemasok') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.pemasok.index') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span>Pemasok</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Transaksi Pemasok -->
    @if(Auth::user()->role === 'admin')
    <li class="nav-item {{ request()->is('dashboard/transaksipemasok') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.transaksipemasok.index') }}">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Transaksi Pemasok</span>
        </a>
    </li>
    @endif

    <!-- Nav Item - Pengguna (Only for super_admin) -->
    @if(Auth::user()->role === 'super_admin')
    <li class="nav-item {{ request()->is('dashboard/pengguna') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.pengguna.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Cetak Dokumen -->
    @if(Auth::user() && Auth::user()->role === 'super_admin')
    <li class="nav-item {{ request()->is('laporan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.index') }}">
            <i class="fas fa-fw fa-print"></i>
            <span>Cetak Dokumen</span>
        </a>
    </li>
    @endif

</ul>
<!-- End of Sidebar -->
