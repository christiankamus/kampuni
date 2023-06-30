<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agent;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgentResource\RelationManagers;
use App\Filament\Resources\AgentResource\RelationManagers\CongesRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\ContratsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\DependantsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\DossierAgentsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\ExperiencesRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\FormationsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\SanctionDisciplinairesRelationManager;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestion RH';

    protected static ?string $navigationLabel = 'Gestion des agents';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Identification de l'agent")
                ->schema([
                    TextInput::make('nom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('postnom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('prenom')
                            ->required()
                            ->maxLength(255),
                ])->columns(3),
                Section::make('Information générale')
                    ->schema([   
                        Select::make('ville_id')
                            ->relationship('ville','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Lieu de naissance'),                     
                        DatePicker::make('date_naissance')
                            ->required()
                            ->label('Date de naissance'),
                        TextInput::make('pere')
                            ->required()
                            ->maxLength(255)
                            ->label('Fils de'),
                        TextInput::make('mere')
                            ->required()
                            ->maxLength(255)
                            ->label('Et de '),
                        Select::make('pays_id')
                            ->relationship('pays','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Nationalité'),
                        Select::make('province_id')
                            ->relationship('province','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Province'),
                        TextInput::make('territoire')
                            ->maxLength(255),
                        TextInput::make('secteur')
                            ->maxLength(255),
                        Select::make('type_piece_identite')
                            ->required()
                            ->options([
                                'Permis de conduire' => 'Permis de conduire',
                                'Passport' => 'Passport',
                                'Carte electeur' => 'Carte electeur',
                            ])
                            ->label("Pièce d'identité"),
                        TextInput::make('numero_piece_identite')
                            ->required()
                            ->maxLength(255)
                            ->label("Numéro de la pièce d'identité"),
                        TextInput::make('telephone')
                            ->tel()
                            ->maxLength(255)
                            ->label('N° Téléphone'),
                        TextInput::make('adresse_email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('position_familiale'),
                        Select::make('etat_civil')
                            ->required()
                            ->options([
                                'Célibataire' => 'Célibataire',
                                'Marié(e)' => 'Marié(e)',
                                'Divorcé(e)' => 'Divorcé(e)',
                                'Veuf(ve)' => 'Veuf(ve)',
                            ]),
                        Select::make('niveau_education_id')
                            ->relationship('niveau_education','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label("Niveau d'étude")
                    ])->columns(4)->collapsible()->collapsed(),


                Section::make('Situation professionnelle')
                    ->schema([
                        TextInput::make('matricule')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        TextInput::make('numero_cnss')
                            ->maxLength(255)
                            ->label('Numéro CNSS'),
                        Select::make('categorie_id')
                            ->relationship('categorie','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Categorie'),                       
                        Select::make('fonction_id')
                            ->relationship('fonction','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Fonction'),
                        Select::make('departement_id')
                            ->relationship('departement','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Departement'), 
                        Select::make('service_id')
                            ->relationship('service','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Service'),
                        Select::make('section_id')
                            ->relationship('section','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Section'),
                        Select::make('site_id')
                            ->relationship('site','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Site'),
                        Select::make('equipe_id')
                            ->relationship('equipe','nom')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Equipe'),       
                ])->columns(4)->collapsible()->collapsed(), 
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('matricule')->searchable()->sortable(),
                TextColumn::make('nom')->searchable()->sortable(),
                TextColumn::make('postnom')->searchable()->sortable(),
                TextColumn::make('prenom')->searchable()->sortable(),
                TextColumn::make('fonction.nom')->label('Fonction'),
                TextColumn::make('departement.nom')->label('Département'),                               
                TextColumn::make('service.nom')->label('Service'),                
                TextColumn::make('site.nom')->label('Site'),

            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            ContratsRelationManager::class,
            DossierAgentsRelationManager::class,
            DependantsRelationManager::class,
            ExperiencesRelationManager::class,
            CongesRelationManager::class,
            FormationsRelationManager::class,
            SanctionDisciplinairesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }    
}
