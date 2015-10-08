<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ratings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('song_id')->unsigned();
            $table->integer('user_rating');
            
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('Users');
            $table->foreign('song_id')
                  ->references('id')
                  ->on('Songs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Ratings');
    }
}
