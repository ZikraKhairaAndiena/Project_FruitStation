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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID untuk pesanan
            $table->foreignId('user_id')->nullable()->constrained('users'); // ID pengguna yang membuat pesanan
            $table->decimal('subtotal', 10, 2); // Subtotal pesanan
            $table->decimal('biaya_pengiriman', 10, 2); // Biaya pengiriman
            $table->decimal('total', 10, 2); // Total biaya (subtotal + biaya pengiriman)
            $table->string('metode_pembayaran'); // Metode pembayaran
            $table->string('metode_pengiriman'); // Metode pengiriman
            $table->string('status')->default('diproses'); // Status pesanan (diproses, dikirim, selesai)
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }

};
