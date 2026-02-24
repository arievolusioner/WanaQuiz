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
        Schema::create('jawaban_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_kuis_id')->constrained('peserta_kuis')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('soal')->onDelete('cascade');
            $table->foreignId('jawaban_opsi_id')->nullable()->constrained('opsi_soal')->nullOnDelete();
            $table->decimal('nilai_final', 5, 2)->default(0.00);
            $table->timestamps();

            $table->unique(['peserta_kuis_id', 'soal_id']);
            $table->boolean('is_benar')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswa');
    }
};
