<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'nom',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function dependants()
    {
        return $this->hasMany(Dependant::class);
    }
}
