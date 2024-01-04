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
        Schema::create('kelengkapan', function (Blueprint $table) {
            $table->id();
            // jadwal_id
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade');
            $table->boolean('rps')->default(0);
            $table->boolean('absen')->default(0);
            $table->boolean('nilai')->default(0);
            $table->boolean('berita_acara')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelengkapan');
    }
};
