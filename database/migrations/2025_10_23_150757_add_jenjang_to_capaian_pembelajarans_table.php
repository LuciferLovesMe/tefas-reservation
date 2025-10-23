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
        Schema::table('capaian_pembelajarans', function (Blueprint $table) {
            $table->enum('jenjang', ['TK', 'SD', 'SMP', 'SMA'])->after('nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('capaian_pembelajarans', function (Blueprint $table) {
            //
        });
    }
};
