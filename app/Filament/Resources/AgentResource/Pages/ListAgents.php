<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\Filament\Resources\AgentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgents extends ListRecords
{
    protected static string $resource = AgentResource::class;

    protected ?string $subheading = 'Cliquer sur un agent pour gérer toutes informations le concernant : Contrats, congé, dépendants, formations, expériences, dossiers';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
