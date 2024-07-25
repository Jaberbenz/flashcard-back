<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UpdateCardsFrontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Récupérer tous les enregistrements de la table 'cards'
        $cards = DB::table('cards')->get();

        foreach ($cards as $card) {
            // Mettre à jour chaque enregistrement avec un texte aléatoire pour la colonne 'front'
            DB::table('cards')
                ->where('id', $card->id)
                ->update(['front' => $faker->sentence()]);
        }
    }
}
