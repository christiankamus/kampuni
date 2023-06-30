<?php

namespace App\Filament\Resources\TypeDocumentResource\Pages;

use App\Filament\Resources\TypeDocumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypeDocuments extends ManageRecords
{
    protected static string $resource = TypeDocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
