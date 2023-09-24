<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\Pointage_Brut;

class PointageController extends Controller
{

    public function InsertPointageBrut(Request $request)
    {
        $input = $request->all();
        $agent = Agent::where('matricule', $request->agent_id)->get()->first();
        if (is_null($agent)) 
        {
            $data = [
                "status" => "Non, Agent ayant le matricule ".$request->agent_id." inexistant dans le système",
                "Message" => "Agent ayant le matricule ".$request->agent_id." inexistant dans le système",             
            ];
        }
        else
        {
            $input['agent_id'] = $agent->id;
            $input['nom'] = $agent->matricule." ".$agent->postnom." ".$agent->prenom;
            $input['heure_entree'] = Carbon::parse($request->heure_entree);
            $input['heure_sortie'] = Carbon::parse($request->heure_sortie);
            $input['date_pointage'] = Carbon::parse($request->date_pointage);
            $input['site'] = Carbon::parse($request->site);
            $input['commentaire'] = $request->commentaire;

            $pointagecheck = Pointage_Brut::where('agent_id',$agent->id)
                                          ->where('date_pointage',Carbon::parse($request->date_pointage))
                                          ->where('site',$request->site);

            if (is_null($pointagecheck )) 
            {
                $pointage = Pointage_Brut::create($input);

                $data = [
                    "status" => "Oui, nouveau pointage créé",
                    "Message" => "Agent ayant le matricule ".$request->agent_id." existe",          
                ];
            }
            else
            {
                $pointagecheck->delete();
                /*$pointagecheck = Pointage_Brut::where('agent_id',$agent->id)
                ->where('heure_entree',Carbon::parse($request->heure_entree))
                ->where('heure_sortie',Carbon::parse($request->heure_sortie))
                ->where('site',$request->site)->get()->first();*/
                $pointage = Pointage_Brut::create($input);
                $data = [
                    "status" => "Oui, ancien pointage mis à jour",
                    "Message" => "Agent ayant le matricule ".$request->agent_id." existe",             
                ];
            }
        }
        

        return $data;
        
    }


    
}
