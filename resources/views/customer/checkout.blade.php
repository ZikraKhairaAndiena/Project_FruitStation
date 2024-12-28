@extends('customer.layouts.main')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <!-- Cart Items Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Cart Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Diskon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subtotal = 0; @endphp
                                @foreach($cartItems as $item)
                                    @php
                                        $totalPrice = $item['price'] * $item['quantity'];
                                        $subtotal += $totalPrice;
                                    @endphp
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($discount, 0, ',', '.') }}</td> <!-- Menampilkan diskon -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h5>Subtotal: <span class="text-primary">Rp {{ number_format($subtotal - $discount, 0, ',', '.') }}</span></h5>
                </div>
            </div>

            <!-- Alamat Pengiriman Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Alamat Pengiriman</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="alamat_pengiriman">Alamat Lengkap</label>
                        <textarea id="alamat_pengiriman" name="alamat_pengiriman" class="form-control" rows="3" placeholder="Masukkan alamat lengkap pengiriman" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Ongkir Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Ongkir</h4>
                </div>
                <div class="card-body">
                    <select class="form-select mb-4" id="ongkir_select" name="ongkir_id" required>
                        <option value="">Pilih ongkir</option>
                        @foreach($ongkirs as $ongkir)
                            <option value="{{ $ongkir->id }}" data-tarif="{{ $ongkir->tarif }}">
                                {{ $ongkir->nama_kota }} - Rp {{ number_format($ongkir->tarif, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Total Price Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Total Pembayaran</h4>
                </div>
                <div class="card-body">
                    <p><strong>Subtotal (Setelah Diskon):</strong> Rp {{ number_format($subtotal - $discount, 0, ',', '.') }}</p>
                    <p><strong>Ongkir:</strong> Rp <span id="ongkir_tarif">0</span></p>
                    <p><strong>Total:</strong> <span id="total_pembayaran">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 rounded-pill mt-4">Proses Checkout</button>
        </form>
    </div>
</div>
<!-- Checkout Page End -->

<script>
    document.getElementById('ongkir_select').addEventListener('change', function () {
        const ongkirTarif = parseInt(this.options[this.selectedIndex].dataset.tarif || 0);
        const subtotal = {{ $subtotal - $discount }};
        const total = subtotal + ongkirTarif;

        // Update ongkir dan total
        document.getElementById('ongkir_tarif').textContent = ongkirTarif.toLocaleString('id-ID');
        document.getElementById('total_pembayaran').textContent = `Rp ${total.toLocaleString('id-ID')}`;
    });
</script>
@endsection
