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
            $table->integer('album_id');
            $table->integer('artist_id');
            $table->integer('song_duration');
            $table->integer('is_explicit');
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
        Schema::drop('Songs');
    }
}
