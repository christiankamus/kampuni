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
            $input['date_heure_pointage'] = Carbon::parse($request->date_heure_pointage);
            $input['date_pointage'] = Carbon::parse($request->date_pointage);

            $pointage = Pointage_Brut::create($input);

            $data = [
                "status" => "Oui",
                "Message" => "Agent ayant le matricule ".$request->agent_id." existe",          
            ];
        }
        

        return $data;
        
    }


    
}
