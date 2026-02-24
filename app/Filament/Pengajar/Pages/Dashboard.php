<?php
namespace App\Filament\Pengajar\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.pengajar.pages.dashboard';

    protected static ?string $title = 'Dashboard Pengajar';

    protected static ?string $navigationLabel = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Pengajar\Widgets\PengajarStats::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2; // Layout 2 kolom untuk widgets
    }
}