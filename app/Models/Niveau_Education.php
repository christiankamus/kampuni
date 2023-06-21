<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau_Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',

    ];

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
