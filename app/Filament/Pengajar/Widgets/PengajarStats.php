<?php

namespace App\Filament\Pengajar\Widgets;

use App\Models\Kuis;
use App\Models\Soal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PengajarStats extends BaseWidget
{
    // Supaya otomatis muncul
    protected static bool $isDiscovered = true;

    protected function getStats(): array
    {
        $pengajarId = Auth::id();

        // Total kuis milik pengajar
        $totalKuis = Kuis::where('user_id', $pengajarId)->count();

        // Ambil semua id kuis
        $kuisIds = Kuis::where('user_id', $pengajarId)->pluck('id');

        // Total soal dari kuis milik pengajar
        $totalSoal = Soal::whereIn('kuis_id', $kuisIds)->count();

        // Kuis aktif
        $kuisAktif = Kuis::where('user_id', $pengajarId)
            ->where('status', 'aktif')
            ->count();

        // Kuis selesai
        $kuisSelesai = Kuis::where('user_id', $pengajarId)
            ->where('status', 'selesai')
            ->count();

        return [

            Stat::make('Total Kuis', $totalKuis)
                ->icon('heroicon-o-clipboard-document-list')
                ->color('primary')
                ->description('Semua kuis yang dibuat'),

            Stat::make('Total Soal', $totalSoal)
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->description('Jumlah soal keseluruhan'),

            Stat::make('Kuis Aktif', $kuisAktif)
                ->icon('heroicon-o-play-circle')
                ->color('warning')
                ->description('Sedang berjalan'),

            Stat::make('Kuis Selesai', $kuisSelesai)
                ->icon('heroicon-o-check-circle')
                ->color('info')
                ->description('Sudah berakhir'),
        ];
    }
}
