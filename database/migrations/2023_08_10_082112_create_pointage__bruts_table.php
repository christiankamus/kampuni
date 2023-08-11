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
        Schema::create('pointage__bruts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrainted();
            $table->date('date_heure_pointage');
            $table->date('date_pointage');
            $table->string('site');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pointage__bruts');
    }
};
