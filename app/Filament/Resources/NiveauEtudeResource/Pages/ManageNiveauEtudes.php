<?php

namespace App\Filament\Resources\NiveauEtudeResource\Pages;

use App\Filament\Resources\NiveauEtudeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNiveauEtudes extends ManageRecords
{
    protected static string $resource = NiveauEtudeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
