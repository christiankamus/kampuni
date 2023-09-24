<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Conge;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CongeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CongeResource\RelationManagers;

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
                Select::make('exercice_id')
                    ->relationship('exercice','nom')
                    ->preload()
                    ->required(),
                Select::make('type_conge_id')
                    ->relationship('type_conge','nom')
                    ->preload()
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
                Tables\Columns\TextColumn::make('exercice.nom')->label('Exercice'),
                Tables\Columns\TextColumn::make('type_conge.nom')->label('Type de congé'),
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
