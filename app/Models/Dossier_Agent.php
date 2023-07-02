<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'type_document_id',
        'commentaire',
        'document',

    ];



    public function type_document()
    {
        return $this->belongsTo(Type_Document::class);
    }

}
