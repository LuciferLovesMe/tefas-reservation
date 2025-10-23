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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_kunjungan_id')->nullable()->constrained('jenis_kunjungans')->onDelete('set null');
            $table->foreignId('aktivitas_id')->nullable()->constrained('aktivitas')->onDelete('set null');
            $table->foreignId('capaian_pembelajaran_id')->nullable()->constrained('capaian_pembelajarans')->onDelete('set null');
            $table->foreignId('tefa_id')->constrained('tefas')->onDelete('cascade');
            $table->integer('prioritas')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
