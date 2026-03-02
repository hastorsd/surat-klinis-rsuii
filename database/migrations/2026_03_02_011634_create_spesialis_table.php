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
        Schema::create('spesialis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ksm_id')->constrained('ksms')->cascadeOnDelete();
            $table->string('spesialis_name'); // ex: urologi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesialis');
    }
};
