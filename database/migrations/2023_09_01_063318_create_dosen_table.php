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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained('prodi')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('NIDN')->nullable();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('jenkel');
            $table->string('agama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
