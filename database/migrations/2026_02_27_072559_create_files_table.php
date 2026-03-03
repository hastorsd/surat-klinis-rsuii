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
        if (!Schema::hasTable('files')) {
            Schema::create('files', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->foreignId('spesialis_id')->nullable()->constrained('spesialis')->nullOnDelete(); // ex: THT-KL, bedah, obsgyn, dll
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete(); // ex: ppk, cp, spo, algoritma
                $table->string('file_path')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
