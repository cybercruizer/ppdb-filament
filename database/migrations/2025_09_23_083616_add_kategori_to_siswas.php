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
            $table->enum('kategori', ['REG', 'AP50', 'AP100','KB','KM','AUM', 'PDK'])
            ->after('jenis_kelamin')
            ->default('REG')
            ->comment('Kategori Siswa: Reguler, AP50, AP100, kakak beradik, kembar, aum,pondok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
