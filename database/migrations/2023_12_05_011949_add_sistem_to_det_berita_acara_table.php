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
        Schema::table('det_berita_acara', function (Blueprint $table) {
            $table->string('sistem', 10)->nullable(); //daring atau luring
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_berita_acara', function (Blueprint $table) {
            $table->dropColumn('sistem');
        });
    }
};
