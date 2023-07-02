<?php

namespace App\Filament\Widgets;

use App\Models\Site;
use App\Models\Agent;
use App\Models\Contrat;
use App\Models\Section;
use App\Models\Service;
use App\Models\Dependant;
use App\Models\Departement;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    
    protected function getCards(): array
    {
        
        return [
            Card::make('Sites', Site::count())
                ->description('Nombre de sites')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Card::make('Départements', Departement::count())
                ->description('Nombre de départements')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Card::make('Services', Service::count())
                ->description('Nombre de services')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Card::make('Sections', Section::count())
                ->description('Nombre de sections')
                ->chart([7, 2, 10, 3, 15, 4, 17]),


            Card::make('Agents', Agent::where('is_actif', 1)->count())
                ->description('Nombre d\'agents actifs')
                ->chart([32, 51, 25, 43, 28, 52, 39])
                ->color('success'),
            Card::make('Dépendants', Dependant::where('is_actif', 1)->count())
                ->description('Nombre de dépendants actifs')
                ->chart([32, 51, 25, 43, 28, 52, 39])
                ->color('success'),


            Card::make('Expiration des contrats', Contrat::where('date_fin','>',now()->addMonth(2))->where('date_fin','<',now()->addMonth(3))->count())
                ->description('Contrats expirant dans moins de 3 mois')
                ->chart([32, 51, 25, 43, 28, 52, 39])
                ->color('warning'),
            Card::make('Expiration des contrats', Contrat::where('date_fin','>',now())->where('date_fin','<',now()->addMonth(2))->count())
                ->description('Contrats expirant dans moins de 2 mois')
                ->chart([32, 51, 25, 43, 28, 52, 39])
                ->color('danger'),
            
        ];
    }
}
