<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormationResource\Pages;
use App\Filament\Resources\FormationResource\RelationManagers;
use App\Models\Formation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('agent_id')
                    ->required(),
                Forms\Components\TextInput::make('entreprise_id')
                    ->required(),
                Forms\Components\DatePicker::make('date_debut')
                    ->required(),
                Forms\Components\DatePicker::make('date_fin')
                    ->required(),
                Forms\Components\TextInput::make('evaluation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('consideration')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agent_id'),
                Tables\Columns\TextColumn::make('entreprise_id'),
                Tables\Columns\TextColumn::make('date_debut')
                    ->date(),
                Tables\Columns\TextColumn::make('date_fin')
                    ->date(),
                Tables\Columns\TextColumn::make('evaluation'),
                Tables\Columns\TextColumn::make('consideration'),
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
            'index' => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormation::route('/create'),
            'edit' => Pages\EditFormation::route('/{record}/edit'),
        ];
    }    
}
