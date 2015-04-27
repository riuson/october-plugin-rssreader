<?php
namespace Riuson\RssReader\Models;

use Model;

/**
 * Channel Model
 */
class Channel extends Model
{

    /**
     *
     * @var string The database table used by the model.
     */
    public $table = 'riuson_rssreader_channels';

    /**
     *
     * @var array Guarded fields
     */
    protected $guarded = [
        '*'
    ];

    /**
     *
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     *
     * @var array Relations
     */
    public $hasOne = [];

    public $hasMany = [
        'items' => [
            'Riuson\RssReader\Models\Item',
            'order' => 'created_at'
        ]
    ];

    public $belongsTo = [];

    public $belongsToMany = [];

    public $morphTo = [];

    public $morphOne = [];

    public $morphMany = [];

    public $attachOne = [];

    public $attachMany = [];
}