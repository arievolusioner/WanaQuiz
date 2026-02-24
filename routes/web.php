<?php

use App\Livewire\Dashboard;
use App\Livewire\Kuis;
use App\Livewire\RiwayatKuis;
use App\Livewire\LihatNilai;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\QrController;
use App\Models\Kuis as KuisModel;
use App\Models\User;
use App\Models\PesertaKuis;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $stats = [
        'pengguna_aktif'  => User::where('role', 'siswa')->count(),
        'kuis_dibuat'     => KuisModel::count(),
        'kuis_dikerjakan' => PesertaKuis::where('status', 'selesai')->count(),
    ];
    return view('about', compact('stats'));
})->name('about');

// ── QR Code — public endpoint (hanya kuis aktif) ─────────────────
// Diakses oleh <img src="/qr/ABCDEF"> di dashboard siswa
Route::get('/qr/{kodeKuis}', [QrController::class, 'generate'])
    ->name('qr.generate');

// ── QR Code — pengajar (semua status) ────────────────────────────
Route::get('/qr/pengajar/{kodeKuis}', [QRController::class, 'pengajar'])
    ->middleware(['auth'])
    ->name('qr.pengajar');

// ── Auth ──────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── Siswa ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->group(function () {

        Route::get('/', Dashboard::class)->name('siswa.dashboard');
        Route::get('/dashboard', Dashboard::class);

        Route::get('/kuis/{peserta}', Kuis::class)
            ->name('kuis.mulai');

        Route::get('/riwayat', RiwayatKuis::class)
            ->name('kuis.riwayat-kuis');

        Route::get('/nilai/{peserta}', LihatNilai::class)
            ->name('kuis.lihat-nilai');

    });

// QR Code — public endpoint (dipakai sebagai <img src="...">)
Route::get('/qr/{kodeKuis}', [QrController::class, 'generate'])
    ->name('qr.generate');

// QR Code SVG — untuk embed di halaman pengajar (semua status)
Route::get('/qr/pengajar/{kodeKuis}', [QrController::class, 'pengajar'])
    ->middleware(['auth'])
    ->name('qr.pengajar');

// Halaman QR Code lengkap — native Blade, hanya pengajar pemilik
Route::get('/pengajar/kuis/{kodeKuis}/qr', [QrController::class, 'halamanQr'])
    ->middleware(['auth', 'role:pengajar'])
    ->name('pengajar.kuis.qr');

require __DIR__ . '/auth.php';