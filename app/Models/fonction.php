<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fonction extends Model
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
