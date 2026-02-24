<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKuis extends Model
{
    use HasFactory;

    protected $table = 'peserta_kuis';

    protected $fillable = [
        'kuis_id',
        'user_id',
        'nilai_total',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'percobaan_ke',
        'is_nilai_terbaik',
    ];

    /* ================= RELATION ================= */

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class);
    }
}
