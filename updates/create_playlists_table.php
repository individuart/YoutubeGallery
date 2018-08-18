<?php namespace Individuart\Videogallery\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePlaylistsTable extends Migration
{
    public function up()
    {
        Schema::create('individuart_videogallery_playlists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('individuart_videogallery_playlists');
    }
}
