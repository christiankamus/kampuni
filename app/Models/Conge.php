<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'exercice_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'jours_pris',

    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function exercice()
    {
        return $this->belongsTo(Exercice::class);
    }

    public function type_conge()
    {
        return $this->belongsTo(type_conge::class);
    }
}
