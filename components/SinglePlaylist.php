<?php namespace Individuart\Videogallery\Components;

use Cms\Classes\ComponentBase;
use Individuart\Videogallery\Models\Playlist;
use Individuart\Videogallery\Models\Video;

class SinglePlaylist extends ComponentBase
{
    /** @var Video[] */
    public $videos = [];

    /** @var string */
    public $name;

    /** @var bool */
    public $hasError = false;

    public function componentDetails()
    {
        return [
            'name'        => 'Playlist Component',
            'description' => 'Displays a list of videos from a playlist'
        ];
    }

    public function defineProperties()
    {
        return [
            'playlist' => [
                'title' => 'Playlist',
                'description' => 'Playlist to display videos from',
                'type' => 'dropdown',
                'required' => true
            ],
            'display_title' => [
                'title' => 'Display title',
                'description' => 'Add the provided display title on top of the video',
                'type' => 'checkbox',
                'default' => false
            ],
            'display_playlist_name' => [
                'title' => 'Display playlist name',
                'description' => 'If checked, will display the playlist name on a row before all videos',
                'type' => 'checkbox',
                'default' => true
            ],
            'sort_by' => [
                'title' => 'Sort column',
                'description' => 'Choose a column to sort on',
                'type' => 'dropdown',
                'required' => true,
                'default' => 'order',
                'options' => [
                    'title' => 'Title',
                    'order' => 'Order',
                    'created_at' => 'Date of creation',
                    'updated_at' => 'Date of modification'
                ]
            ],
            'sort_direction' => [
                'title' => 'Sort direction',
                'description' => 'Ascending or descending sort',
                'type' => 'dropdown',
                'default' => 'asc',
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ]
            ]
        ];
    }

    public function getPlaylistOptions()
    {
        $options = [];
        foreach (Playlist::all() as $playlist) {
            $options[$playlist->id] = $playlist->name;
        }

        return $options;
    }

    public function onRun()
    {
        $this->addJs('components/assets/js/venobox.min.js');
        $this->addJs('components/assets/js/singleplaylist.js');
        $this->assetPath = env('DOCUMENT_ROOT') . '/plugins/individuart/videogallery/';
        $this->addCss(['components/assets/scss/venobox.scss']);


        $playlist = Playlist::find($this->property('playlist'));
        if ($playlist) {
            $this->name = $playlist->name;
            $this->videos = $playlist->videos()->where('published', true)->orderBy(
                $this->property('sort_by'),
                $this->property('sort_direction')
            )->get();
            return;
        }

        $this->hasError = true;
    }
}
