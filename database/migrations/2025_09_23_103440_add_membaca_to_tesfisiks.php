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
        Schema::table('tesfisiks', function (Blueprint $table) {
            $table->enum('membaca',['L','KL','TB'])->after('alquran')->nullable()->comment('L: Lancar, KL: Kurang Lancar, TB: Tidak Bisa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tesfisiks', function (Blueprint $table) {
            $table->dropColumn('membaca');
        });
    }
};
