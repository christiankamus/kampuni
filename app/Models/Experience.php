<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'entreprise_id',
        'date_debut',
        'date_fin',
        'details',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

}
