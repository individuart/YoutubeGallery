<?php

namespace Individuart\Videogallery\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * video Model
 */
class Video extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'individuart_videogallery_videos';

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title'];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['title', 'idvideo', 'published', 'yt_watch', 'video_type'];

    public $rules = [
        'title' => 'required',
        'idvideo' => 'required',
        'published' => 'boolean'
    ];

    public $attributeNames = [
        'title' => 'individuart.videogallery::lang.plugin.models.video.attributes.title',
        'yt_watch' => 'individuart.videogallery::lang.plugin.models.video.attributes.yt_watch'
    ];

    /**
     * Tries to extract YouTube video id if a full YouTube url was given
     *
     * @param $value
     */
    public function setYtWatchAttribute($value)
    {
        preg_match(
            '/(?:https?:)?(?:\/\/)?(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\S*?[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:[\'"][^<>]*>|<\/a>))[?=&+%\w.-]*/',
            $value,
            $matches
        );

        $this->attributes['yt_watch'] = (isset($matches[1])) ? $matches[1] : $value;
    }

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'playlists' => [
            Playlist::class,
            'table' => 'individuart_videogallery_playlist_video'
        ],
        'playlists_count' => [
            Playlist::class,
            'table' => 'individuart_videogallery_playlist_video',
            'count' => true
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'video_image' => ['System\Models\File']
    ];
    public $attachMany = [];


    public function getImageAttribute()
    {
        $item = Video::find($this->id);
        if ($item->video_image) {
            return '<img src="' . $item->video_image->getThumb(50, 50, 'crop') . '">';
        } else {
            return '';
        }
    }

    public function getVideoTypeOptions($value, $formData)
    {
        return [1 => 'Youtube', 2 => 'Vimeo'];
    }
}
