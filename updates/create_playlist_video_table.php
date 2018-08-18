<?php

namespace Individuart\Videogallery\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePlaylistVideoTable extends Migration
{
    public function up()
    {
        Schema::create('individuart_videogallery_playlist_video', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('playlist_id');
            $table->unsignedInteger('video_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('individuart_videogallery_playlist_video');
    }
}
