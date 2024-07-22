<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->text('front_text')->nullable();
            $table->string('front_image')->nullable();
            $table->string('front_video')->nullable();
            $table->string('front_audio')->nullable();
            $table->text('back');
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
