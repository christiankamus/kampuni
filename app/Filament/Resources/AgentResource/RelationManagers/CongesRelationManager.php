<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CongesRelationManager extends RelationManager
{
    protected static string $relationship = 'Conges';

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('exercice_id')
                    ->relationship('exercice','nom')
                    ->preload()
                    ->searchable()
                    ->required(),
                DatePicker::make('date_debut')
                    ->required(),
                DatePicker::make('date_fin')
                    ->after('date_debut')
                    ->required(),
                TextInput::make('jours_pris')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exercice.nom'),
                TextColumn::make('date_debut')
                    ->dateTime('d-M-Y')->sortable(),
                TextColumn::make('date_fin')                    
                    ->dateTime('d-M-Y')->sortable(),
                TextColumn::make('jours_pris'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
