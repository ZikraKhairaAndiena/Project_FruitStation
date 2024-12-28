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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ongkir_id'); // Pastikan ini adalah unsignedBigInteger
            $table->date('tanggal_pembelian');
            $table->decimal('total_pembelian', 15, 2);
            $table->string('nama_kota', 100);
            $table->decimal('tarif', 15, 2);
            $table->text('alamat_pengiriman');
            $table->enum('status_pembelian', ['pending', 'proses', 'dikirim', 'selesai', 'batal']);
            $table->string('resi_pengiriman', 50)->nullable();
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('ongkir_id')->references('id')->on('ongkirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
