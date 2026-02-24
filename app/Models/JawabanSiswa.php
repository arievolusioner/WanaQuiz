<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'peserta_kuis_id',
        'soal_id',
        'jawaban_opsi_id',
        'nilai_final',
        'is_benar',
    ];

    /* ================= RELATION ================= */

    public function peserta()
    {
        return $this->belongsTo(PesertaKuis::class, 'peserta_kuis_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function opsi()
    {
        return $this->belongsTo(OpsiSoal::class, 'jawaban_opsi_id');
    }
}
