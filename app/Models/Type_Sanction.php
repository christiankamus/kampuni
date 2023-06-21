<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Sanction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function sanction_disciplinaires()
    {
        return $this->hasMany(Sanction_Disciplinaire::class);
    }
}
