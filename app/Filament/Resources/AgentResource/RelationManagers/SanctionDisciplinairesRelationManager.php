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

class SanctionDisciplinairesRelationManager extends RelationManager
{
    protected static string $relationship = 'Sanction_Disciplinaires';

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date_sanction')
                    ->required(),
                Select::make('type_sanction_id')
                    ->relationship('type_sanction','nom')
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('faute_commise')
                    ->required()
                    ->maxLength(255),
                TextInput::make('observation')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_sanction')
                    ->dateTime('d-M-Y')->sortable(),
                TextColumn::make('type_sanction.nom'),
                TextColumn::make('faute_commise'),
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
