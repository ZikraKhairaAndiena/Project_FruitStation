@extends('customer.layouts.main')

@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start -->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        {{-- <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div> --}}
                    </div>
                    <div class="col-6"></div>
                    <div class="col-lg-12 text-end mb-4">
                        <form id="categorySortForm" method="GET" action="{{ route('customer.shop') }}" class="d-inline-flex">
                            <div class="input-group">
                                <label class="input-group-text bg-light" for="kategori_id">Sort by Category:</label>
                                <select id="kategori_id" name="kategori_id" class="form-select" onchange="document.getElementById('categorySortForm').submit();">
                                    <!-- Option to display all products -->
                                    <option value="" {{ request('kategori_id') ? '' : 'selected' }}>All Products</option>

                                    <!-- Options for each category -->
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            {{-- <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li><div class="d-flex justify-content-between fruite-name"><a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a><span>(3)</span></div></li>
                                        <li><div class="d-flex justify-content-between fruite-name"><a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a><span>(5)</span></div></li>
                                        <li><div class="d-flex justify-content-between fruite-name"><a href="#"><i class="fas fa-apple-alt me-2"></i>Strawberries</a><span>(2)</span></div></li>
                                        <li><div class="d-flex justify-content-between fruite-name"><a href="#"><i class="fas fa-apple-alt me-2"></i>Bananas</a><span>(8)</span></div></li>
                                        <li><div class="d-flex justify-content-between fruite-name"><a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkins</a><span>(5)</span></div></li>
                                    </ul>
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4 justify-content-center">
                                    @foreach($produks as $produk)
                                        @if($produk->stok_produk > 0)
                                            <div class="col-md-6 col-lg-4 col-xl-4 d-flex align-items-stretch">
                                                <div class="rounded position-relative fruite-item h-100 d-flex flex-column">
                                                    <div class="fruite-img" style="height: 250px; overflow: hidden;">
                                                        <a href="{{ url('customer/product/' . $produk->id) }}">
                                                            <img src="{{ asset('img/' . $produk->gambar_produk) }}" class="img-fluid w-100 h-100 object-fit-cover rounded-top" alt="{{ $produk->nama_produk }}">
                                                        </a>
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center d-flex flex-column justify-content-between flex-grow-1">
                                                        <div>
                                                            <h4>{{ $produk->nama_produk }}</h4>
                                                            <div class="d-flex justify-content-center flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp{{ number_format($produk->harga_produk) }} / {{ $produk->satuan }}</p>
                                                            </div>
                                                            <p class="text-muted mb-2">Stock: {{ $produk->stok_produk }} kg</p>
                                                        </div>
                                                        <div>
                                                            @if(Auth::check())
                                                                <form action="{{ route('customer.cart.add') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary mt-2">
                                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to Cart
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <button class="btn border border-secondary rounded-pill px-3 text-primary mt-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to Cart
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="pagination d-flex justify-content-center mt-5">
                            <a href="#" class="rounded">&laquo;</a>
                            <a href="#" class="active rounded">1</a>
                            <a href="#" class="rounded">2</a>
                            <a href="#" class="rounded">3</a>
                            <a href="#" class="rounded">4</a>
                            <a href="#" class="rounded">5</a>
                            <a href="#" class="rounded">6</a>
                            <a href="#" class="rounded">&raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End -->

<!-- Login Modal Start -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please login to add items to your cart.
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Login Modal End -->



@endsection
