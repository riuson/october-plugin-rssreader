<?php
namespace Riuson\RssReader\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Riuson\RssReader\Models\Channel as ChannelModel;
use Riuson\RssReader\Models\Item as ItemModel;

class RssChannel extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'RssChannel Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'channel' => [
                'title' => 'Channel',
                'description' => 'Selected channel',
                'default' => '{{ :slug }}',
                'type' => 'dropdown'
            ],
            'itemsPerPage' => [
                'title' => 'Items per page',
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'rainlab.blog::lang.settings.posts_per_page_validation',
                'default' => '10'
            ],
            'mode' => [
                'description' => 'Display mode',
                'title' => 'Mode',
                'type' => 'dropdown',
                'default' => 'short',
                'options' => [
                    'full' => 'With descriptions',
                    'short' => 'Title only'
                ]
            ],
            'feedPage' => [
                'title'       => 'rainlab.blog::lang.settings.posts_category',
                'description' => 'rainlab.blog::lang.settings.posts_category_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
                'group'       => 'Links',
            ],
        ];
    }

    public function getChannelOptions()
    {
        return [
            '' => '- none -'
        ] + \Riuson\RssReader\Models\Channel::orderBy('name', 'asc')->lists('name', 'slug');
    }

    public function getFeedPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->channel = null;
        $this->items = null;

        $channelSlug = $this->property('channel', '');
        $this->showFull = $this->property('mode', 'short') === 'full';
        $this->feedPage = $this->property('feedPage');

        if (! empty($channelSlug)) {
            $this->channel = ChannelModel::whereSlug($channelSlug)->first();
            $this->items = ItemModel::listFrontEnd([
                'page' => $this->property('pageNumber'),
                'sort' => $this->property('sortOrder'),
                'perPage' => $this->property('itemsPerPage'),
                'channelSlug' => $channelSlug
            ]);
        }
    }
}