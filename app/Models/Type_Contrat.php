<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
