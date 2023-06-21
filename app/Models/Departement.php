<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
