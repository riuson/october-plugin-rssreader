<?php
namespace Riuson\RssReader\Models;

use Model;

/**
 * Item Model
 */
class Item extends Model
{

    /**
     *
     * @var string The database table used by the model.
     */
    public $table = 'riuson_rssreader_items';

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

    public $hasMany = [];

    public $belongsTo = [
        'channel' => [
            'Riuson\RssReader\Models\Channel'
        ]
    ];

    public $belongsToMany = [];

    public $morphTo = [];

    public $morphOne = [];

    public $morphMany = [];

    public $attachOne = [];

    public $attachMany = [];
}