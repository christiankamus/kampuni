<?php

namespace App\Filament\Resources\SanctionDisciplinaireResource\Pages;

use App\Filament\Resources\SanctionDisciplinaireResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSanctionDisciplinaires extends ListRecords
{
    protected static string $resource = SanctionDisciplinaireResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
