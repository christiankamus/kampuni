<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SanctionDisciplinaireResource\Pages;
use App\Filament\Resources\SanctionDisciplinaireResource\RelationManagers;
use App\Models\SanctionDisciplinaire;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SanctionDisciplinaireResource extends Resource
{
    protected static ?string $model = SanctionDisciplinaire::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSanctionDisciplinaires::route('/'),
            'create' => Pages\CreateSanctionDisciplinaire::route('/create'),
            'edit' => Pages\EditSanctionDisciplinaire::route('/{record}/edit'),
        ];
    }    
}
