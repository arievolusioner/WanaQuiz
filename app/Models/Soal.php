<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'kuis_id',
        'teks_soal',
        'bobot_nilai',
    ];

    /* ================= RELATION ================= */

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }

    public function opsi()
    {
        return $this->hasMany(OpsiSoal::class);
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class);
    }
}
