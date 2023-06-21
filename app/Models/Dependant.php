<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependant extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'relation',
        'nom',
        'postnom',
        'prenom',
        'ville_id',
        'date_naissance',
        'is_actif',
        'observation',
    ];



    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

}
