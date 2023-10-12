<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_flights', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constraint('user')->onDelete('cascade');

            $table->string('speed');
            $table->string('x');
            $table->string('y');
            
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
        Schema::dropIfExists('in_flights');
    }
}
