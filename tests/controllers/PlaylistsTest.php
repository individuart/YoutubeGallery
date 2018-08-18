<?php

namespace individuart\videogallery\tests\controllers;

use PluginTestCase;
use Individuart\Videogallery\Controllers\Playlists;

/**
 * Class PlaylistsTest
 *
 * @package individuart\videogallery\tests\controllers
 */
class PlaylistsTest extends PluginTestCase
{
    /**
     * @test
     */
    public function can_instantiate_playlists_controller()
    {
        new Playlists();
    }
}
