<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parametre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin par défaut
        User::updateOrCreate(
            ['email' => 'adenikeinter@gmail.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('admin123'),
            ]
        );

        // Paramètres par défaut (basés sur le brief PDF)
        Parametre::updateOrCreate(
            ['id' => 1],
            [
                'nom_societe' => 'ADENIKE-INTER SARL',
                'description' => "ADENIKE-INTER SARL est une grande société créée en 2017 au Bénin par Monsieur A. Razack HOUINSOU. Elle est spécialisée dans la commercialisation des matériaux de construction de tout type : plomberie, maçonnerie, menuiserie, barres de fer, tuyauteries, etc.",
                'telephone' => '(+229) 01 66 44 27 31',
                'telephone2' => '(+229) 01 63 45 97 44',
                'whatsapp' => '22901664427031',
                'email' => 'adenikeinter@gmail.com',
                'email2' => 'adenikeinter0@gmail.com',
                'adresse' => 'Porto-Novo, Bénin',
                'horaires' => "Lun-Ven : 08h00 - 18h00 | Sam : 08h00 - 15h00",
                'annee_creation' => 2017,
                'slogan' => 'Votre partenaire de confiance pour la construction',
            ]
        );
    }
}