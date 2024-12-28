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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelian_id');
            $table->string('nama_penyetor', 100);
            $table->string('bank', 50);
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->string('bukti')->nullable();
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('pembelian_id')->references('id')->on('pembelians')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
