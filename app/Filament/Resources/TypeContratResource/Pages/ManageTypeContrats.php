<?php

namespace App\Filament\Resources\TypeContratResource\Pages;

use App\Filament\Resources\TypeContratResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypeContrats extends ManageRecords
{
    protected static string $resource = TypeContratResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
