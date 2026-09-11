<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calon_murids', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('nama');
            $table->string('asal_smp');
            $table->text('alamat');
            $table->string('nama_ortu');
            $table->string('no_wa', 20);
            $table->string('scan_kk'); // path file hasil upload
            $table->foreignId('murid_pendamping_id')
                ->nullable()
                ->constrained('murid_aktifs')
                ->nullOnDelete();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('calon_murids');
    }
};
