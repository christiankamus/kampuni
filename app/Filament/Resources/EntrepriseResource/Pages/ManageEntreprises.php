<?php

namespace App\Filament\Resources\EntrepriseResource\Pages;

use App\Filament\Resources\EntrepriseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEntreprises extends ManageRecords
{
    protected static string $resource = EntrepriseResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
