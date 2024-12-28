@extends('customer.layouts.main')

@section('content')
<div class="container py-5" style="padding-top: 100px;">
    <div class="card shadow-sm mt-4">
        <div class="card-header text-center bg-light">
            <h3 class="mb-0">Beri Ulasan untuk Pembelian #{{ $pembelian->id }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('simpan.ulasan', ['id' => $pembelian->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <div id="rating" class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}"><i class="far fa-star"></i></span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-input" required>
                </div>

                <!-- Keterangan Rating -->
                <div id="rating-description" class="mt-2 text-muted"></div>
                <div class="mb-3">
                    <label for="komentar" class="form-label">Komentar</label>
                    <textarea name="komentar" id="komentar" class="form-control" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Unggah Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan CSS di sini atau di file CSS terpisah -->
<style>
    .star {
        cursor: pointer;
        color: gray;
    }

    .star.fas {
        color: gold;
    }
</style>

<!-- Tambahkan JavaScript di bagian bawah -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating-input');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;
                updateStars(value);
            });
        });

        function updateStars(value) {
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= value) {
                    star.querySelector('i').classList.remove('far');
                    star.querySelector('i').classList.add('fas');
                } else {
                    star.querySelector('i').classList.remove('fas');
                    star.querySelector('i').classList.add('far');
                }
            });
        }

        // Fungsi untuk menampilkan keterangan berdasarkan rating
    function updateDescription(value) {
        let description = '';
        switch (parseInt(value)) {
            case 1:
                description = 'Sangat Buruk';
                break;
            case 2:
                description = 'Buruk';
                break;
            case 3:
                description = 'Cukup';
                break;
            case 4:
                description = 'Bagus';
                break;
            case 5:
                description = 'Sangat Bagus';
                break;
            default:
                description = '';
        }
        ratingDescription.textContent = description;
    }
    });
</script>
@endsection
