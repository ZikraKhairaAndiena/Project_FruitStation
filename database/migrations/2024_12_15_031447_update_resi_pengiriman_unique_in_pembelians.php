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
        Schema::table('pembelians', function (Blueprint $table) {
            // Menambahkan constraint unik pada kolom resi_pengiriman
            $table->string('resi_pengiriman', 50)->nullable()->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelians', function (Blueprint $table) {
            // Menghapus constraint unik dari kolom resi_pengiriman
            $table->dropUnique(['resi_pengiriman']);
        });
    }
};
