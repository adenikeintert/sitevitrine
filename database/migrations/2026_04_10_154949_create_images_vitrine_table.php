<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images_vitrine', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('image');
            $table->enum('categorie', ['hero', 'produit', 'entreprise', 'equipe', 'service'])->default('produit');
            $table->integer('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();

            $table->index(['categorie', 'actif', 'ordre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images_vitrine');
    }
};