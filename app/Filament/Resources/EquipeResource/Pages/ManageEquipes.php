<?php

namespace App\Filament\Resources\EquipeResource\Pages;

use App\Filament\Resources\EquipeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEquipes extends ManageRecords
{
    protected static string $resource = EquipeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
