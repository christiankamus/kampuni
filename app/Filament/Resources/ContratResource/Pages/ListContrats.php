<?php

namespace App\Filament\Resources\ContratResource\Pages;

use App\Filament\Resources\ContratResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContrats extends ListRecords
{
    protected static string $resource = ContratResource::class;

    protected ?string $heading = 'Contrats presque à terme';
    protected ?string $subheading = 'Liste des contrats qui expirent dans moins de 3 mois';

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
