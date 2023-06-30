<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function dossier_agents()
    {
        return $this->hasMany(Dossier_Agent::class);
    }
}
