<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class DependantsRelationManager extends RelationManager
{
    protected static string $relationship = 'dependants';

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('relation')
                    ->required()
                    ->options([
                        'Enfant' => 'Enfant',
                        'Conjoint' => 'Conjoint',
                    ]),
                TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                TextInput::make('postnom')
                    ->required()
                    ->maxLength(255),
                TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                Select::make('ville_id')
                    ->relationship('ville','nom')
                    ->required()
                    ->label('Lieu de naissance'),
                DatePicker::make('date_naissance')
                    ->before('yesterday')
                    ->required(),
                Toggle::make('is_actif')
                    ->label('Est actif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('relation'),
                TextColumn::make('nom')->sortable(),
                TextColumn::make('postnom')->sortable(),
                TextColumn::make('prenom')->sortable(),
                TextColumn::make('ville.nom')->sortable()->label('Lieu de naissance'),
                TextColumn::make('date_naissance')->label('Date de naissance')
                    ->dateTime('d-M-Y')->sortable(),
                IconColumn::make('is_actif')->label('Est actif')
                    ->boolean()->sortable(),
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
