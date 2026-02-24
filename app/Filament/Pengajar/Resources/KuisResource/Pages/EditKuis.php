<?php

namespace App\Filament\Pengajar\Resources\KuisResource\Pages;

use App\Filament\Pengajar\Resources\KuisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKuis extends EditRecord
{
    protected static string $resource = KuisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
