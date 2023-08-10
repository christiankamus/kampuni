<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'postnom',
        'prenom',
        'pere',
        'mere',
        'position_familiale',
        'date_naissance',
        'pays_id',
        'province_id',
        'ville_id',
        'territoire',
        'secteur',
        'type_piece_identite',
        'numero_piece_identite',
        'telephone',
        'adresse_email',
        'etat_civil',
        'niveau_education_id',
        'numero_cnss',
        'categorie_id',
        'fonction_id',
        'equipe_id',
        'section_id',
        'service_id',
        'departement_id',
        'site_id',
        'is_actif',
    ];

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function sanction_disciplinaires()
    {
        return $this->hasMany(Sanction_Disciplinaire::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function dependants()
    {
        return $this->hasMany(Dependant::class);
    }

    public function dossier_agents()
    {
        return $this->hasMany(Dossier_Agent::class);
    }


    public function conges()
    {
        return $this->hasMany(Conge::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function niveau_education()
    {
        return $this->belongsTo(Niveau_Education::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
