<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('album_name');
            $table->string('album_image_loc');
            $table->integer('artist_id')->unsigned();
            $table->timestamps();

            $table->foreign('artist_id')
                  ->references('id')
                  ->on('Artists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Albums');
    }
}