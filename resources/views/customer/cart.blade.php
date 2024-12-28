@extends('customer.layouts.main')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @if(session('cart') && is_array(session('cart')))
                        @foreach(session('cart') as $id => $details)
                        <tr data-id="{{ $id }}">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/' . ($details['gambar_produk'] ?? 'default-image.jpg')) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="{{ $details['name'] }}">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{ $details['name'] }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $details['quantity'] }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                @if($details['discount'] > 0)
                                    <p class="mb-0 mt-4 text-success">Diskon: {{ $details['discount'] }}%</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-md btn-remove rounded-circle bg-light border mt-4">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Your cart is empty.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="border-bottom">
                    <div class="d-flex justify-content-between py-3">
                        <h5 class="m-0">Total Diskon</h5>
                        <h5 class="m-0 text-success" id="discount-display">
                            Rp {{ number_format(session('discount', 0), 0, ',', '.') }}
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between py-3">
                        <h5 class="m-0">Subtotal</h5>
                        <h5 class="m-0" id="subtotal-display">
                            Rp {{ number_format(session('subtotal', 0) - session('discount', 0), 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
                <div class="d-flex justify-content-between py-3">
                </div>
                <div class="d-flex flex-column">
                    <a class="btn btn-primary w-100 rounded-pill" href="{{ route('checkout.form') }}">Checkout</a>
                    <a class="btn btn-secondary mt-3 rounded-pill" href="{{ route('customer.home') }}">Lanjutkan Belanja</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- JavaScript Code -->
<script>


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-minus').forEach(function(button) {
        button.addEventListener('click', function() {
            let row = this.closest('tr');
            let input = row.querySelector('input');
            let quantity = parseInt(input.value) - 1;
            if (quantity > 0) {
                updateCart(row.dataset.id, quantity);
            }
        });
    });

    document.querySelectorAll('.btn-plus').forEach(function(button) {
        button.addEventListener('click', function() {
            let row = this.closest('tr');
            let input = row.querySelector('input');
            let quantity = parseInt(input.value) + 1;
            updateCart(row.dataset.id, quantity);
        });
    });

    document.querySelectorAll('.btn-remove').forEach(function(button) {
        button.addEventListener('click', function() {
            let row = this.closest('tr');
            removeFromCart(row.dataset.id);
        });
    });

    function updateCart(id, quantity) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    function removeFromCart(id) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: id
            })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
});

</script>
<!-- Cart Page End -->
@endsection
