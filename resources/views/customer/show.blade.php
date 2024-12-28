@extends('customer.layouts.main')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-3 fw-bold text-primary" style="text-transform: uppercase;">{{ $produk->nama_produk }}</h1>
        <p class="lead text-muted">{{ $produk->nama_produk }}</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <img src="{{ asset('img/' . $produk->gambar_produk) }}" class="img-fluid rounded-top" alt="{{ $produk->nama_produk }}">
                <div class="card-body">
                    <h4 class="mb-3 fw-bold text-success">Rp{{ number_format($produk->harga_produk) }}</h4>
                    <p class="text-muted mb-4">Stock: {{ $produk->stok_produk }} kg</p>
                    <p class="text-secondary h5" style="line-height: 1.6;">{{ $produk->deskripsi_produk }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        {{-- @if(Auth::check())
                            <!-- Form to Add to Cart -->
                            <form action="{{ route('cart') }}" method="GET">
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa fa-shopping-bag me-2"></i> Add to cart
                                </button>
                            </form>
                        @else
                            <button class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="fa fa-lock me-2"></i> Add to cart
                            </button>
                        @endif --}}
                        <a href="{{ url('customer/home') }}" class="btn btn-secondary rounded-pill">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Login Notification -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Pemberitahuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda belum memiliki akun, silakan untuk daftar terlebih dahulu.
            </div>
            <div class="modal-footer">
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sekarang</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
