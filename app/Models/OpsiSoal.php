<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpsiSoal extends Model
{
    use HasFactory;

    protected $table = 'opsi_soal';

    protected $fillable = [
        'soal_id',
        'text_opsi',
        'opsi_benar',
    ];

    /* ================= RELATION ================= */

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
