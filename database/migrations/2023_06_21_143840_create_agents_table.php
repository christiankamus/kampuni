<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->string('pere');
            $table->string('mere');
            $table->integer('position_familiale')->nullable();
            $table->date('date_naissance');
            $table->foreignId('pays_id')->constrainted();
            $table->foreignId('province_id')->constrainted();
            $table->foreignId('ville_id')->constrainted();
            $table->string('territoire')->nullable();
            $table->string('secteur')->nullable();
            $table->string('type_piece_identite');
            $table->string('numero_piece_identite');
            $table->string('telephone')->nullable();
            $table->string('adresse_email')->nullable();
            $table->string('etat_civil');
            $table->foreignId('niveau_education_id')->constrainted()->nullable();
            $table->string('numero_cnss')->nullable();
            $table->foreignId('categorie_id')->constrainted();
            $table->foreignId('fonction_id')->constrainted();
            $table->foreignId('equipe_id')->constrainted()->nullable();
            $table->foreignId('section_id')->constrainted()->nullable();
            $table->foreignId('service_id')->constrainted();
            $table->foreignId('departement_id')->constrainted();
            $table->foreignId('site_id')->constrainted();
            $table->boolean('is_actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
