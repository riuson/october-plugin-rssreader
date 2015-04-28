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

    /*
     * Validation
     */
    public $rules = [
        'guid' => 'unique:riuson_rssreader_channels'
    ];

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
     * The attributes on which the item list can be ordered
     *
     * @var array
     */
    public static $allowedSortingOptions = array(
        'title asc' => 'Title (ascending)',
        'title desc' => 'Title (descending)',
        'created_at asc' => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc' => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
        'description asc' => 'Published (ascending)',
        'description desc' => 'Published (descending)'
    );

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

    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page' => 1,
            'perPage' => 30,
            'sort' => 'created_at',
            'channelSlug' => null,
            'search' => ''
        ], $options));

        $searchableFields = [
            'title',
            'description'
        ];

        /*
         * Sorting
         */
        if (! is_array($sort))
            $sort = [
                $sort
            ];
        foreach ($sort as $_sort) {

            if (in_array($_sort, array_keys(self::$allowedSortingOptions))) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2)
                    array_push($parts, 'desc');
                list ($sortField, $sortDirection) = $parts;

                $query->orderBy($sortField, $sortDirection);
            }
        }

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        /*
         * Channel
         */
        if ($channelSlug !== null) {
            $query->where('channel_id', function($query2) use ($channelSlug)
            {
                $query2->select('id')->from('riuson_rssreader_channels')->where('slug', '=', $channelSlug);
            });
        }

        return $query->paginate($perPage, $page);
    }
}