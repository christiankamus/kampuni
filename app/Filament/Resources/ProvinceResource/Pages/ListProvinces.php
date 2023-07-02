<?php

namespace App\Filament\Resources\ProvinceResource\Pages;

use App\Filament\Resources\ProvinceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvinces extends ListRecords
{
    protected static string $resource = ProvinceResource::class;

    protected ?string $heading = 'Liste des provinces';
    protected ?string $subheading = 'Veuillez cliquer sur une province pour le modifier ou gérer ses villes';

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
