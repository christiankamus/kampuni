<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage_Brut extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'nom',
        'heure_entree',
        'heure_sortie',
        'date_pointage',
        'site',
        'commentaire'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
