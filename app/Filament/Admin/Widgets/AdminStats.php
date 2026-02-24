<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends BaseWidget
{
    // ⛔ Matikan auto load
    protected static bool $isDiscovered = false;

    protected function getStats(): array
    {
        return [

            Stat::make('Total User', User::count())
                ->icon('heroicon-o-users')
                ->color('primary')
                ->description('Semua akun')
                ->descriptionColor('primary'),

            Stat::make('Admin', User::where('role', 'admin')->count())
                ->icon('heroicon-o-shield-check')
                ->color('danger')
                ->description('Administrator')
                ->descriptionColor('danger'),

            Stat::make('Pengajar', User::where('role', 'pengajar')->count())
                ->icon('heroicon-o-academic-cap')
                ->color('warning')
                ->description('Guru')
                ->descriptionColor('warning'),

            Stat::make('Siswa', User::where('role', 'siswa')->count())
                ->icon('heroicon-o-user')
                ->color('success')
                ->description('Peserta')
                ->descriptionColor('success'),

        ];
    }
}
