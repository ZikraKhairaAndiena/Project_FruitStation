@extends('customer.layouts.main')

@section('content')
<div class="container py-5 text-center">
    <div class="alert alert-success">
        <h2 class="mb-4">Checkout Berhasil!</h2>
        <p>Terima kasih telah berbelanja dengan kami.</p>
        <p>Pesanan Anda sedang diproses dan akan segera kami kirim.</p>
        <p>Ringkasan Pesanan:</p>
        <ul class="list-unstyled">
            <li>Subtotal: Rp{{ number_format($subtotal, 2) }}</li>
            <li>Pengiriman: Rp{{ number_format($shippingCost, 2) }}</li>
            <li>Total: Rp{{ number_format($total, 2) }}</li>
        </ul>
        <a href="{{ route('customer.home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
</div>
@endsection
