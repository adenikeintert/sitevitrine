<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->string('nom_societe')->nullable();
            $table->text('description')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->text('adresse')->nullable();
            $table->string('logo')->nullable();
            $table->string('nif')->nullable();
            $table->string('rcm')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->text('horaires')->nullable();
            $table->integer('annee_creation')->nullable();
            $table->string('slogan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};