<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'pays_id',
        'nom',
    ];

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}
