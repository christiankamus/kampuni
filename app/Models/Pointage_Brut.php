<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage_Brut extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'date_heure_pointage',
        'date_pointage',
        'site'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
