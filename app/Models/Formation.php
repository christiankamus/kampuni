<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'entreprise_id',
        'date_debut',
        'date_fin',
        'evaluation',
        'consideration',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
