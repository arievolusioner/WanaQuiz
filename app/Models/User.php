<?php

namespace App\Models;

use App\Models\Kuis;
use App\Models\PesertaKuis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ================= RELATION ================= */

    // Pengajar → punya banyak kuis
    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'user_id');
    }

    // Siswa → ikut banyak kuis
    public function pesertaKuis()
    {
        return $this->hasMany(PesertaKuis::class, 'user_id');
    }

    /* ================= HELPER ROLE ================= */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPengajar()
    {
        return $this->role === 'pengajar';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
}
