<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;


    protected $fillable = [
        'code_pays',
        'nom',
    ];

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}
