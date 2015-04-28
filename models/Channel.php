<?php
namespace Riuson\RssReader\Models;

use Model;

/**
 * Channel Model
 */
class Channel extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     *
     * @var string The database table used by the model.
     */
    public $table = 'riuson_rssreader_channels';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'slug' => 'required|between:3,64|unique:riuson_rssreader_channels',
        'url' => 'required'
    ];

    public function beforeValidate()
    {
        // Generate a URL slug for this model
        if (! $this->exists && ! $this->slug)
            $this->slug = \Str::slug($this->name);

        if (! $this->slug)
            $this->slug = \Str::slug($this->name);
    }

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