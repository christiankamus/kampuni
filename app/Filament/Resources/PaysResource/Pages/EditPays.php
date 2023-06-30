<?php

namespace App\Filament\Resources\PaysResource\Pages;

use App\Filament\Resources\PaysResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPays extends EditRecord
{
    protected static string $resource = PaysResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
