<?php

namespace App\Filament\Resources;

use App;
use Filament\Forms;
use App\Models\Pays;
use App\Models\Site;
use Filament\Tables;
use App\Models\Agent;
use App\Models\Ville;
use App\Models\Service;
use App\Models\Province;
use App\Models\Departement;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgentResource\RelationManagers;
use App\Filament\Resources\AgentResource\RelationManagers\CongesRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\ContratsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\DependantsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\FormationsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\ExperiencesRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\DossierAgentsRelationManager;
use App\Filament\Resources\AgentResource\RelationManagers\SanctionDisciplinairesRelationManager;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestion RH';

    protected static ?string $navigationLabel = 'Gestion des agents';

    public static function getEloquentQuery(): Builder
    {

        $site= Site::where('user_id',auth()->user()->id)->get()->first();
        //echo (!$site)?"Aucun site géré par cet utilisateur":$site->nom;
        if (auth()->user()->hasAnyRole(['gsp']))
        {
            Notification::make() 
            ->title("Liste partielle des agents")
            ->body((!$site)?"Vous ne voyez aucun agent car aucun site n'est sous votre gestion":"Vous voyez les agents du site de **".$site->nom."**")
            ->icon('heroicon-o-document-text') 
            ->warning()
            ->seconds(10)
            ->send();
            return parent::getEloquentQuery()->where('site_id', (!$site)?0:$site->id);
        }
        else 
        {
            Notification::make() 
            ->title("Liste complète des agents")
            ->title("Vous voyez les agents de tous les sites car vous êtes **".strtoupper(auth()->user()->roles->first()->name)."**")
            ->icon('heroicon-o-document-text') 
            ->success()
            ->seconds(10)
            ->send();
            return parent::getEloquentQuery();
        }

        
    }

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
                        Select::make('pays_id')
                            ->label('Nationalité')
                            ->options(Pays::all()->pluck('nom','id')->toArray())                            
                            ->reactive()
                            ->preload()
                            ->searchable()
                            ->afterStateUpdated(fn (callable $set) => $set('province_id', null) )
                            ->required(),
                        Select::make('province_id')
                            ->label('Province')
                            ->options(function(callable $get){
                                $pays = Pays::find($get('pays_id'));
                                if (!$pays)
                                {
                                    return Province::all()->pluck('nom','id')->toArray();
                                }
                                return $pays->provinces->pluck('nom','id')->toArray();
                            })
                            ->reactive()
                            ->searchable()
                            ->preload()
                            ->afterStateUpdated(fn (callable $set) => $set('ville_id', null) )
                            ->required(),
                        Select::make('ville_id')
                            ->label('Ville')
                            ->options(function(callable $get){
                                $province = Province::find($get('province_id'));
                                if (!$province)
                                {
                                    return Ville::all()->pluck('nom','id')->toArray();
                                }
                                return $province->villes->pluck('nom','id')->toArray();
                            })
                            ->searchable()
                            ->reactive()
                            ->preload()
                            ->required(),       
                        TextInput::make('territoire')
                            ->maxLength(255),
                        TextInput::make('secteur')
                            ->maxLength(255),              
                        DatePicker::make('date_naissance')
                            ->before('yesterday')
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
                            ->label("Niveau d'étude"),
                        Toggle::make('is_actif')
                            ->label('Est actif')
                            ->required(),
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
                            ->options(Departement::all()->pluck('nom','id')->toArray())                            
                            ->reactive()
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Departement')
                            ->afterStateUpdated(fn (callable $set) => $set('service_id', null) ), 
                        Select::make('service_id')
                            ->options(function(callable $get){
                                $dept = Departement::find($get('departement_id'));
                                if (!$dept)
                                {
                                    return Service::all()->pluck('nom','id')->toArray();
                                }
                                return $dept->services->pluck('nom','id')->toArray();
                            })
                            ->reactive()
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Service')
                            ->afterStateUpdated(fn (callable $set) => $set('section_id', null) ),
                        Select::make('section_id')
                            ->options(function(callable $get){
                                $service = Service::find($get('service_id'));
                                if (!$service)
                                {
                                    return App\Models\Section::all()->pluck('nom','id')->toArray();
                                }
                                return $service->sections->pluck('nom','id')->toArray();
                            })
                            ->reactive()
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Section'),
                        Select::make('site_id')
                            ->options(function(callable $get){
                                $site =  $site= Site::where('user_id',auth()->user()->id)->get()->first();
                                if (auth()->user()->hasAnyRole(['gsp']))
                                {
                                    return Site::where('id', (!$site)?0:$site->id)->pluck('nom','id')->toArray();
                                }
                                else return  Site::all()->pluck('nom','id')->toArray();
                            })
                            ->searchable()
                            ->reactive()
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
                IconColumn::make('is_actif')->label('Est actif')
                    ->boolean()->sortable(),
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
                Filter::make('is_actif', fn ($query) => $query->where('is_actif', 0))
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
