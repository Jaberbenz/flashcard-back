<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            // Ajouter la nouvelle colonne 'front'
            $table->text('front')->after('id')->nullable();

            // Supprimer les anciennes colonnes
            $table->dropColumn('front_text');
            $table->dropColumn('front_image');
            $table->dropColumn('front_audio');
            $table->dropColumn('front_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            // Ajouter les colonnes supprimées
            $table->text('front_text')->nullable();
            $table->string('front_image')->nullable();
            $table->string('front_audio')->nullable();
            $table->string('front_video')->nullable();

            // Supprimer la nouvelle colonne 'front'
            $table->dropColumn('front');
        });
    }
}
