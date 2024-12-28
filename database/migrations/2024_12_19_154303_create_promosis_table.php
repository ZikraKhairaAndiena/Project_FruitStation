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
        Schema::create('promosis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onDelete('cascade'); // ID produk yang terkait dengan promosi
            $table->string('description')->nullable(); // deskripsi singkat
            $table->integer('quantity_required')->nullable(); // jumlah pembelian minimum untuk quantity_discount
            $table->decimal('discount_percentage', 5); // persentase diskon
            $table->date('start_date'); // tanggal mulai promosi
            $table->date('end_date'); // tanggal berakhir promosi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosis');
    }
};

