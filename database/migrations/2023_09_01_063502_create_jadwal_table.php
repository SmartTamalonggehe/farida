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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained('prodi')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('matkul_id')->constrained('matkul')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ruangan_id')->constrained('ruangan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('hari', 8);
            $table->time('mulai');
            $table->time('seles');
            $table->string('semester', 8);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
