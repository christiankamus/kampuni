<?php

namespace App\Filament\Resources\TypeSanctionResource\Pages;

use App\Filament\Resources\TypeSanctionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypeSanctions extends ManageRecords
{
    protected static string $resource = TypeSanctionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
