<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Contrat;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ContratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContratResource\RelationManagers;

class ContratResource extends Resource
{
    protected static ?string $model = Contrat::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                    Select::make('type_contrat_id')
                        ->relationship('type_contrat','nom')
                        ->preload()
                        ->required(),
                    TextInput::make('agent_id')
                        ->required(),
                    TextInput::make('mode_entree')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('date_debut')
                        ->required(),
                    DatePicker::make('date_fin'),
                    TextInput::make('raison_sortie')
                        ->maxLength(255),
                    TextInput::make('commentaire')
                        ->maxLength(255),
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type_contrat_id'),
                TextColumn::make('agent_id'),
                TextColumn::make('mode_entree'),
                TextColumn::make('date_debut')
                    ->date(),
                TextColumn::make('date_fin')
                    ->date(),
                TextColumn::make('raison_sortie'),
                TextColumn::make('commentaire'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListContrats::route('/'),
            'create' => Pages\CreateContrat::route('/create'),
            'edit' => Pages\EditContrat::route('/{record}/edit'),
        ];
    }    
}
