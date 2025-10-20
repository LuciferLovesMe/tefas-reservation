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
        Schema::create('tefa_kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tefa_id')->constrained('tefas')->onDelete('cascade');
            $table->foreignId('jenis_kunjungan_id')->constrained('jenis_kunjungans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tefa_kunjungans');
    }
};
