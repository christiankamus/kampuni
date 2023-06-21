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
        Schema::create('dependants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrainted();
            $table->string('relation');
            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->foreignId('ville_id')->constrainted();
            $table->date('date_naissance');
            $table->boolean('is_actif');
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependants');
    }
};
