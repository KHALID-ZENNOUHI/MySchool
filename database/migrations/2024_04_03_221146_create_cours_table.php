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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->integer('jours');
            $table->time('start_time');
            $table->time('end_time');
            // $table->foreignId('salle_id')->constrained();
            $table->foreignId('matiere_id')->constrained();
            $table->foreignId('formateur_id')->constrained();
            $table->foreignId('classe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
