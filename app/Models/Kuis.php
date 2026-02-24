<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $table = 'kuis';

    protected $fillable = [
        'user_id',
        'nama_kuis',
        'deskripsi',
        'kode_kuis',
        'barcode_path',
        'maks_percobaan',
        'waktu_pengerjaan',
        'acak_soal',
        'acak_opsi',
        'poin_pilgan',
        'total_poin',
        'status',
        'mulai_dari',
        'akhir_pada',
        'is_public',
    ];

    /* ================= RELATION ================= */

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }


    public function peserta()
    {
        return $this->hasMany(PesertaKuis::class);
    }
}
