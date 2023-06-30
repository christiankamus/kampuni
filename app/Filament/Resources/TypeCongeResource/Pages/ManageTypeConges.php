<?php

namespace App\Filament\Resources\TypeCongeResource\Pages;

use App\Filament\Resources\TypeCongeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypeConges extends ManageRecords
{
    protected static string $resource = TypeCongeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
