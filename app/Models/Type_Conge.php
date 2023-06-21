<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function conges()
    {
        return $this->hasMany(Conge::class);
    }
}
