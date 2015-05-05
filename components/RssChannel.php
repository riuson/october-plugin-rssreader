<?php
namespace Riuson\RssReader\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Riuson\RssReader\Models\Channel as ChannelModel;
use Riuson\RssReader\Models\Item as ItemModel;

class RssChannel extends ComponentBase
{
    /**
     * A rss channel display
     * @var object
     */
    public $channel;

    /**
     * A collection of items to display
     * @var Collection
     */
    public $items;

    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    public function componentDetails()
    {
        return [
            'name' => 'riuson.rssreader::lang.rss_channel.name',
            'description' => 'riuson.rssreader::lang.rss_channel.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'channel' => [
                'title' => 'riuson.rssreader::lang.rss_channel.channel_title',
                'description' => 'riuson.rssreader::lang.rss_channel.channel_description',
                'default' => '{{ :slug }}',
                'type' => 'dropdown'
            ],
            'itemsPerPage' => [
                'title' => 'riuson.rssreader::lang.rss_channel.itemsperpage_title',
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'rainlab.blog::lang.settings.posts_per_page_validation',
                'default' => '10'
            ],
            'mode' => [
                'title' => 'riuson.rssreader::lang.rss_channel.mode_title',
                'description' => 'riuson.rssreader::lang.rss_channel.mode_description',
                'type' => 'dropdown',
                'default' => 'short',
                'options' => [
                    'full' => 'riuson.rssreader::lang.rss_channel.mode_option_full',
                    'short' => 'riuson.rssreader::lang.rss_channel.mode_option_short'
                ]
            ],
            'showPager' => [
                'title' => 'riuson.rssreader::lang.rss_channel.showpager_title',
                'description' => 'riuson.rssreader::lang.rss_channel.showpager_description',
                'type' => 'dropdown',
                'default' => 'hide',
                'options' => [
                    'hide' => 'riuson.rssreader::lang.rss_channel.showpager_option_hide',
                    'show' => 'riuson.rssreader::lang.rss_channel.showpager_option_show'
                ]
            ],
            'feedPage' => [
                'title' => 'riuson.rssreader::lang.rss_channel.feedpage_title',
                'description' => 'riuson.rssreader::lang.rss_channel.feedpage_description',
                'type' => 'dropdown',
                'default' => 'blog/category',
                'group' => 'Links'
            ],
            'pageNumber' => [
                'title' => 'riuson.rssreader::lang.rss_channel.pagenumber_title',
                'type' => 'string',
                'default' => '{{ :page }}'
            ]
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
        $this->showPager = $this->property('showPager', 'hide') === 'show';
        $this->feedPage = $this->property('feedPage');

        if (! empty($channelSlug)) {
            $this->channel = ChannelModel::whereSlug($channelSlug)->first();
            $this->items = ItemModel::listFrontEnd([
                'page' => $this->property('pageNumber'),
                'sort' => 'pubDate desc',
                'perPage' => $this->property('itemsPerPage'),
                'channelSlug' => $channelSlug
            ]);
        }

        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');

            if ($currentPage > ($lastPage = $this->items->lastPage()) && $currentPage > 1)
                return Redirect::to($this->currentPageUrl([
                    $pageNumberParam => $lastPage
                ]));
        }
    }
}