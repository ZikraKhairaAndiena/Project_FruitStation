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
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Mengganti id INT PRIMARY KEY AUTO_INCREMENT
            $table->char('produk_id')->unique();
            $table->foreignId('kategori_id');
            $table->string('nama_produk', 100);
            $table->integer('stok_produk');
            $table->string('satuan', 20);
            $table->decimal('harga_produk', 10);
            $table->text('deskripsi_produk');
            $table->string('gambar_produk', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
