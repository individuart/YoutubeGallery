<?php

namespace Individuart\Videogallery;

use Backend;
use System\Classes\PluginBase;

/**
 * videogallery Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'October Video Gallery',
            'description' => 'Make galleries out of YouTube and Vimeo videos',
            'author' => 'Individuart fork from lunfel',
            'icon'        => 'icon-youtube-play'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Individuart\Videogallery\Components\SinglePlaylist' => 'Playlist',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        $tab = 'YouTube Video Gallery';

        return [
            'individuart.videogallery.tab' => [
                'label' => 'Show the YouTube Video Gallery tab in the backend',
                'tab' => $tab
            ],
            'individuart.videogallery.access_videos' => [
                'label' => 'Access to the video section',
                'tab' => $tab
            ],
            'individuart.videogallery.access_playlists' => [
                'label' => 'Access to the playlist section',
                'tab' => $tab
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'videogallery' => [
                'label' => 'individuart.videogallery::lang.plugin.navigation.label',
                'url' => Backend::url('individuart/videogallery/videos'),
                'icon'        => 'icon-youtube-play',
                'permissions' => ['individuart.videogallery.tab'],
                'order'       => 500,
                'sideMenu' => [
                    'videos' => [
                        'label' => 'individuart.videogallery::lang.plugin.navigation.sidemenu.videos.label',
                        'icon' => 'icon-video-camera',
                        'url' => Backend::url('individuart/videogallery/videos'),
                        'permissions' => ['individuart.videogallery.access_videos']
                    ],
                    'playlists' => [
                        'label' => 'individuart.videogallery::lang.plugin.navigation.sidemenu.playlists.label',
                        'icon' => 'icon-list',
                        'url' => Backend::url('individuart/videogallery/playlists'),
                        'permissions' => ['individuart.videogallery.access_playlists']
                    ]
                ]
            ],
        ];
    }
}
