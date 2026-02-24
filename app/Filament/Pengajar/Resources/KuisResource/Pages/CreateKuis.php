<?php

namespace App\Filament\Pengajar\Resources\KuisResource\Pages;

use App\Filament\Pengajar\Resources\KuisResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateKuis extends CreateRecord
{
    use HasWizard;

    protected static string $resource = KuisResource::class;

    /**
     * Ambil steps dari KuisResource agar tidak duplikasi kode.
     */
    protected function getSteps(): array
    {
        return KuisResource::getFormSteps();
    }

    /**
     * Ganti label tombol "Next" menjadi "Selanjutnya"
     */
    protected function getNextWizardStepAction(): \Filament\Forms\Components\Actions\Action
    {
        return parent::getNextWizardStepAction()
            ->label('Selanjutnya')
            ->icon('heroicon-o-arrow-right')
            ->iconPosition(\Filament\Support\Enums\IconPosition::After);
    }

    /**
     * Ganti label tombol "Previous" menjadi "Sebelumnya"
     */
    protected function getPreviousWizardStepAction(): \Filament\Forms\Components\Actions\Action
    {
        return parent::getPreviousWizardStepAction()
            ->label('Sebelumnya');
    }

    /**
     * Sembunyikan semua tombol form bawaan (Create, Create Another, Cancel).
     * HasWizard akan secara otomatis menampilkan tombol Next/Previous/Submit
     * yang sesuai per step — tanpa perlu tombol-tombol ini.
     */
    protected function getFormActions(): array
    {
        return [];
    }

    /**
     * Ganti label tombol Submit (muncul di step terakhir) menjadi "Simpan Kuis"
     */
    protected function getSubmitFormAction(): \Filament\Actions\Action
    {
        return parent::getSubmitFormAction()
            ->label('Simpan Kuis')
            ->icon('heroicon-o-check')
            ->color('success');
    }
}