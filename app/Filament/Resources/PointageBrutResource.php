<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use App\Models\Pointage_Brut;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PointageBrutResource\Pages;
use App\Filament\Resources\PointageBrutResource\RelationManagers;
use Carbon\Carbon;

class PointageBrutResource extends Resource
{
    protected static ?string $model = Pointage_Brut::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';

    protected static ?string $navigationGroup = 'Gestion RH';

    protected static ?string $navigationLabel = 'Pointages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            //->page([10, 25, 50, 100, 'all'])
            ->columns([
                TextColumn::make('agent.matricule')->label('Matricule')->searchable()->sortable(),
                TextColumn::make('agent.nom')->label('Nom')->searchable()->sortable(),
                TextColumn::make('agent.postnom')->label('Post Nom'),
                TextColumn::make('agent.prenom')->label('Prénom'),
                TextColumn::make('date_pointage')
                    ->dateTime('d-M-Y')->sortable()->label('Date'),
                TextColumn::make('heure_entree')
                    ->dateTime('d-M-Y H:m')->sortable()->label('Entrée'),
                TextColumn::make('heure_sortie')
                    ->dateTime('d-M-Y H:m')->sortable()->label('Sortie'),
                TextColumn::make('site'),
                TextColumn::make('commentaire'),
            ])
            ->filters([
                Filter::make('created_at')->label('Période')
                ->form([
                    Forms\Components\DatePicker::make('Debut'),
                    Forms\Components\DatePicker::make('Fin'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['Debut'],
                            fn (Builder $query, $date): Builder => $query->whereDate('Date_Pointage', '>=', $date),
                        )
                        ->when(
                            $data['Fin'],
                            fn (Builder $query, $date): Builder => $query->whereDate('Date_Pointage', '<=', $date),
                        );
                }),
                
                    
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePointageBruts::route('/'),
        ];
    }    
}
