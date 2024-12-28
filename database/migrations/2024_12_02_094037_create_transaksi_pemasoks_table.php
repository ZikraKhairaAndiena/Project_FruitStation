<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_pemasoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemasok_id')->constrained('pemasoks')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade'); // Menambahkan kolom produk_id yang menghubungkan ke tabel produk
            $table->integer('jumlah');
            $table->decimal('total_harga', 15, 2); // Tidak ada harga satuan
            $table->date('tanggal_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pemasoks');
    }
};
