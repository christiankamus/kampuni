<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CongeResource\Pages;
use App\Filament\Resources\CongeResource\RelationManagers;
use App\Models\Conge;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CongeResource extends Resource
{
    protected static ?string $model = Conge::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('agent_id')
                    ->required(),
                Forms\Components\TextInput::make('exercice_id')
                    ->required(),
                Forms\Components\DatePicker::make('date_debut')
                    ->required(),
                Forms\Components\DatePicker::make('date_fin')
                    ->required(),
                Forms\Components\TextInput::make('jours_pris')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agent_id'),
                Tables\Columns\TextColumn::make('exercice_id'),
                Tables\Columns\TextColumn::make('date_debut')
                    ->date(),
                Tables\Columns\TextColumn::make('date_fin')
                    ->date(),
                Tables\Columns\TextColumn::make('jours_pris'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListConges::route('/'),
            'create' => Pages\CreateConge::route('/create'),
            'edit' => Pages\EditConge::route('/{record}/edit'),
        ];
    }    
}
