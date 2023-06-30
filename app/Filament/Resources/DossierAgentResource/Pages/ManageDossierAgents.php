<?php

namespace App\Filament\Resources\DossierAgentResource\Pages;

use App\Filament\Resources\DossierAgentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDossierAgents extends ManageRecords
{
    protected static string $resource = DossierAgentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
