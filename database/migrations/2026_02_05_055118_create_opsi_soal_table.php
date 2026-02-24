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
        Schema::create('opsi_soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id')->constrained('soal')->onDelete('cascade');
            $table->string('text_opsi', 255);
            $table->boolean('opsi_benar');
            $table->timestamps();

            $table->index('soal_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opsi_soal');
    }
};
