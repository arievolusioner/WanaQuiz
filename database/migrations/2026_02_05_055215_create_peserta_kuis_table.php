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
        Schema::create('peserta_kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('nilai_total', 5, 2)->default(0.00);
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->enum('status', ['belum_mulai', 'mengerjakan', 'selesai'])->default('belum_mulai');
            $table->integer('percobaan_ke')->default(1);
            $table->boolean('is_nilai_terbaik')->default(false);
            $table->timestamps();

            $table->unique(['kuis_id', 'user_id', 'percobaan_ke']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_kuis');
    }
};
