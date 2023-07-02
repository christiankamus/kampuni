<?php

namespace App\Filament\Resources\PaysResource\Pages;

use App\Filament\Resources\PaysResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPays extends ListRecords
{
    protected static string $resource = PaysResource::class;

    protected ?string $heading = 'Liste des pays';
    protected ?string $subheading = 'Veuillez cliquer sur un pays pour le modifier ou gérer ses provinces';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
