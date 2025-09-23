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
        Schema::table('siswas', function (Blueprint $table) {
            $table->enum('informasi',['MS','TM','TT','GR','SK'])->after('asal_sekolah')->nullable()->comment('MS: Media Sosial, TM: Teman, TT: Tetangga, GR: Guru, SK: Sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('informasi');
        });
    }
};
