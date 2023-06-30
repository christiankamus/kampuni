<?php

namespace App\Filament\Resources\VilleResource\Pages;

use App\Filament\Resources\VilleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVilles extends ManageRecords
{
    protected static string $resource = VilleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
