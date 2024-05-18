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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['exercice', 'avis', 'exam']);
            $table->string('title');
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->foreign('matiere_id')->references('id')->on('matieres');
            $table->dateTime('date');
            $table->string('ressources')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('formateur_id');
            $table->foreign('formateur_id')->references('user_id')->on('formateurs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
