<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanction_Disciplinaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'date_sanction',
        'type_sanction_id',
        'faute_commise',
        'observation',
    ];



    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function type_sanction()
    {
        return $this->belongsTo(Type_Sanction::class);
    }
}
