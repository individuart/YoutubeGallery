<?php

namespace individuart\videogallery\tests\controllers;

use PluginTestCase;
use Individuart\Videogallery\Controllers\Videos;

/**
 * Class VideosTest
 *
 * @package individuart\videogallery\tests\controllers
 *
 */
class VideosTest extends PluginTestCase
{
    /**
     * @test
     */
    public function can_instantiate_videos_controller()
    {
        new Videos();
    }
}
