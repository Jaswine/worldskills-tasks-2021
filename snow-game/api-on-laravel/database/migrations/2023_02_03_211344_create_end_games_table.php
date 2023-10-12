<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constraint('user')->onDelete('cascade');
            
            $table->string('startGame');
            $table->string('angle');
            $table->string('power');
            $table->string('endGame');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('end_games');
    }
}
