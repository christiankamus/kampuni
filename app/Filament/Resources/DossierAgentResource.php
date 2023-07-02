<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use App\Models\Dossier_Agent;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DossierAgentResource\Pages;
use App\Filament\Resources\DossierAgentResource\RelationManagers;

class DossierAgentResource extends Resource
{
    protected static ?string $model = Dossier_Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type_document_id')
                    ->relationship('type_document','nom')
                    ->preload()
                    ->searchable()
                    ->required(),
                FileUpload::make('document'),
                TextInput::make('commentaire')
                    ->maxLength(255),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type_document.nom')->sortable(),
                TextColumn::make('commentaire')->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d-M-Y')->label('Créé le')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDossierAgents::route('/'),
        ];
    }    
}
