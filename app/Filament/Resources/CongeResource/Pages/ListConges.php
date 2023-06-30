<?php

namespace App\Filament\Resources\CongeResource\Pages;

use App\Filament\Resources\CongeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConges extends ListRecords
{
    protected static string $resource = CongeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
