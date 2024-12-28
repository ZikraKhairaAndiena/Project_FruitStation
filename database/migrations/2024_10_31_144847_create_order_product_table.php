<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Relasi ke tabel orders
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade'); // Relasi ke tabel products
            $table->string('nama_produk'); // Menyimpan nama produk pada saat pesanan dibuat
            $table->integer('quantity'); // Jumlah produk dalam pesanan
            $table->decimal('price', 10, 2); // Harga produk pada saat pesanan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
