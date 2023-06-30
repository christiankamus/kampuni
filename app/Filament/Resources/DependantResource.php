<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Dependant;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DependantResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DependantResource\RelationManagers;

class DependantResource extends Resource
{
    protected static ?string $model = Dependant::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('agent_id')
                    ->relationship('agent','nom')
                    ->required(),
                Select::make('relationship')
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
                    ->required(),
                DatePicker::make('birth_date')
                    ->required(),
                Toggle::make('is_actif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')->sortable()->searchable(),
                TextColumn::make('relationship'),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('lastname')->sortable()->searchable(),
                TextColumn::make('firstname')->sortable()->searchable(),
                TextColumn::make('city.name')->sortable()->searchable(),
                TextColumn::make('birth_date')
                    ->date()->sortable(),
                IconColumn::make('is_actif')
                    ->boolean()->sortable()->searchable(),
                TextColumn::make('created_at')
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
            'index' => Pages\ListDependants::route('/'),
            'create' => Pages\CreateDependant::route('/create'),
            'edit' => Pages\EditDependant::route('/{record}/edit'),
        ];
    }    
}
