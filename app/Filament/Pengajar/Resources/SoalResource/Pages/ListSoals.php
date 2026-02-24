<?php

namespace App\Filament\Pengajar\Resources\SoalResource\Pages;

use App\Filament\Pengajar\Resources\SoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoals extends ListRecords
{
    protected static string $resource = SoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
