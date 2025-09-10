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
        Schema::create('detail_tefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tefa_id')->constrained('tefas')->onDelete('cascade');
            $table->enum('type', ['fasilitas', 'produk', 'kegiatan']);
            $table->string('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tefas');
    }
};
