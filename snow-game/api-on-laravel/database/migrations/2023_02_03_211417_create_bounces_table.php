<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bounces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constraint('user')->onDelete('cascade');

            $table->string('speed');
            $table->string('baseAngle');
            $table->string('lastAngle');
            $table->string('power');
            $table->string('time');

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
        Schema::dropIfExists('bounces');
    }
}
