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
        Schema::create('dosen_login', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')
                ->cascadeOnDelete()->cascadeOnUpdate()->uniqid();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate()->uniqid();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_login');
    }
};
