<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusPembelianOnPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah kolom status_pembelian
        Schema::table('pembelians', function (Blueprint $table) {
            $table->enum('status_pembelian', [
                'pending',               // Pembayaran belum dilakukan
                'sudah kirim pembayaran', // Pembayaran telah diajukan
                'barang dikirim',        // Pembelian telah diproses
                'selesai',               // Pembelian telah selesai
                'batal'                  // Pembelian dibatalkan
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelians', function (Blueprint $table) {
            // Kembalikan ke enum yang sebelumnya, sesuaikan jika perlu
            $table->enum('status_pembelian', [
                'pending',
                'proses',
                'dikirim',
                'selesai',
                'batal'
            ])->change();
        });
    }
}
