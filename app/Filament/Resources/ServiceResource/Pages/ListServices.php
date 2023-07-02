<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected ?string $heading = 'Liste des services';

    protected ?string $subheading = 'Veuillez cliquer sur un service pour le modifier ou gérer ses sections';

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
