<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('song_name', 30);
            $table->integer('album_id')->unsigned();
            $table->integer('song_rating');
            $table->integer('song_duration');
            $table->integer('is_explicit');
            $table->integer('file_id')->unique()->unsigned();
            $table->timestamps();

            $table->foreign('file_id')
                  ->references('id')
                  ->on('Files');
            $table->foreign('album_id')
                  ->references('id')
                  ->on('Albums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Songs');
    }
}
