<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Playlist_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playlist_id')->unsigned();
            $table->integer('song_id')->unsigned();
            $table->timestamps();

            $table->foreign('playlist_id')
                  ->references('id')
                  ->on('Playlists')
                  ->onDelete('cascade');
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
        Schema::drop('Playlist_contents');
    }
}
