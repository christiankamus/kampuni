<?php

namespace App\Filament\Resources\PointageBrutResource\Pages;

use App\Filament\Resources\PointageBrutResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePointageBruts extends ManageRecords
{
    protected static string $resource = PointageBrutResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
