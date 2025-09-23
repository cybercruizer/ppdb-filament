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
            $table->foreignId('tahun_id')->constrained('tahuns')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('gelombang_id')->constrained('gelombangs')->onDelete('cascade');
        });
        Schema::table('tagihans', function (Blueprint $table) {       
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            //$table->foreignId('tahun_id')->constrained('tahuns')->onDelete('cascade');
            //$table->foreignId('gelombang_id')->constrained('gelombangs')->onDelete('cascade');
        });
        Schema::table('pembayarans', function (Blueprint $table) {       
            //$table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('tagihan_id')->constrained('tagihans')->onDelete('cascade');
        });
        Schema::table('tesfisiks', function (Blueprint $table) {       
            //$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
        });
        Schema::table('gelombangs', function (Blueprint $table) {       
            $table->foreignId('tahun_id')->constrained('tahuns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['tahun_id']);
            $table->dropForeign(['jurusan_id']);
            $table->dropForeign(['gelombang_id']);
        });
        Schema::table('tagihans', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['tahun_id']);
            $table->dropForeign(['gelombang_id']);
        });
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['tagihan_id']);
        });
        Schema::table('tesfisiks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['siswa_id']);
        });
        Schema::table('gelombangs', function (Blueprint $table) {
            $table->dropForeign(['tahun_id']);
        });
    }
};
