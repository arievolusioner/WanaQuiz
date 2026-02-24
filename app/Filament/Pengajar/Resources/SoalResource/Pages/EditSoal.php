<?php

namespace App\Filament\Pengajar\Resources\SoalResource\Pages;

use App\Filament\Pengajar\Resources\SoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoal extends EditRecord
{
    protected static string $resource = SoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
