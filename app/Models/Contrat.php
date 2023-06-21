<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'type_contrat_id',
        'mode_entree',
        'date_debut',
        'date_fin',
        'raison_sortie',
        'commentaire',
    ];


    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function type_contrat()
    {
        return $this->belongsTo(Type_Contrat::class);
    }
}
