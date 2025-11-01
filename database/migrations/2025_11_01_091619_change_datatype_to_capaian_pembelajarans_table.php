<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('capaian_pembelajarans', function (Blueprint $table) {
            DB::statement('ALTER TABLE capaian_pembelajarans MODIFY COLUMN jenjang VARCHAR(10) DEFAULT NULL');
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
