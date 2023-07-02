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

class ContratsRelationManager extends RelationManager
{
    protected static string $relationship = 'contrats';

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Select::make('type_contrat_id')
                        ->relationship('type_contrat','nom')
                        ->preload()
                        ->required(),
                    Select::make('mode_entree')
                        ->required()
                        ->options([
                            'Embauche' => 'Embauche',
                            'Transfert' => 'Transfert',
                        ]),
                    DatePicker::make('date_debut')
                        ->required(),
                    DatePicker::make('date_fin')
                        ->after('date_debut'),
                    Select::make('raison_sortie')
                        ->options([
                            'Démission' => 'Démission',
                            'Desertion' => 'Desertion',
                            'Licenciement avec préavis' => 'Licenciement avec préavis',
                            'Licenciement sans préavis' => 'Licenciement sans préavis',
                            'Retraite' => 'Retraite',
                        ]),
                    TextInput::make('commentaire')
                        ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type_contrat.nom'),
                TextColumn::make('mode_entree'),
                TextColumn::make('date_debut')
                    ->dateTime('d-M-Y')->sortable()->label('Début contrat'),
                TextColumn::make('date_fin')
                    ->dateTime('d-M-Y')->sortable()->label('Fin contrat'),
                TextColumn::make('raison_sortie'),
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
