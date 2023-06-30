<?php

namespace App\Filament\Resources\ExerciceResource\Pages;

use App\Filament\Resources\ExerciceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageExercices extends ManageRecords
{
    protected static string $resource = ExerciceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
