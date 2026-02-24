<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    /**
     * Generate QR Code SVG — public endpoint untuk siswa.
     * Hanya kuis aktif. Digunakan sebagai <img src="/qr/KODE">.
     */
    public function generate(string $kodeKuis)
    {
        $kuis = Kuis::whereRaw('UPPER(kode_kuis) = ?', [strtoupper($kodeKuis)])
            ->firstOrFail();

        $payload = strtoupper($kuis->kode_kuis);

        $svg = QrCode::format('svg')
            ->size(200)
            ->margin(1)
            ->errorCorrection('M')
            ->color(124, 58, 237)
            ->backgroundColor(255, 255, 255)
            ->generate($payload);

        return response($svg, 200)->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Generate QR SVG — untuk embed di halaman pengajar.
     * Semua status kuis boleh.
     */
    public function pengajar(string $kodeKuis)
    {
        $kuis = Kuis::whereRaw('UPPER(kode_kuis) = ?', [strtoupper($kodeKuis)])
            ->firstOrFail();

        $payload = strtoupper($kuis->kode_kuis);

        $svg = QrCode::format('svg')
            ->size(350)
            ->margin(2)
            ->errorCorrection('M')
            ->color(109, 40, 217)
            ->backgroundColor(255, 255, 255)
            ->generate($payload);

        return response($svg, 200)->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Halaman QR Code lengkap — native Blade, bukan Livewire.
     * Hanya bisa diakses pengajar pemilik kuis (auth + role:pengajar).
     */
    public function halamanQr(string $kodeKuis)
    {
        $kuis = Kuis::with(['pengajar', 'soal'])
            ->whereRaw('UPPER(kode_kuis) = ?', [strtoupper($kodeKuis)])
            ->firstOrFail();

        // Pastikan hanya pengajar pemilik yang bisa akses
        if (Auth::id() !== $kuis->user_id) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $jumlahSoal   = $kuis->soal()->count();
        $jumlahPeserta = $kuis->peserta()->count();
        $qrUrl        = route('qr.pengajar', $kuis->kode_kuis);

        return view('qr', compact('kuis', 'jumlahSoal', 'jumlahPeserta', 'qrUrl'));
    }
}