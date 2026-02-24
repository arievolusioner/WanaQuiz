<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Admin\Widgets\AdminStats::class,
        ];
    }

    public function getSubheading(): ?string
    {
        return 'Selamat datang di sistem manajemen WanaQuiz';
    }
}
