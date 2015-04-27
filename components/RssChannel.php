<?php
namespace Riuson\RssReader\Components;

use Cms\Classes\ComponentBase;
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
                'default' => '',
                'type' => 'dropdown'
            ],
            'itemsPerPage' => [
                'title' => 'Items per page',
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'rainlab.blog::lang.settings.posts_per_page_validation',
                'default' => '10'
            ]
        ];
    }

    public function getChannelOptions()
    {
        return [
            '' => '- none -'
        ] + \Riuson\RssReader\Models\Channel::orderBy('title', 'asc')->lists('title', 'id');
    }

    public function onRun()
    {
        $this->channel = null;
        $this->items = null;

        $channelID = intval($this->property('channel', '0'));

        if ($channelID > 0) {
            $this->channel = ChannelModel::find($channelID);
            $this->items = ItemModel::listFrontEnd([
            'page'       => $this->property('pageNumber'),
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $this->property('itemsPerPage'),
            'channelID' => $channelID
        ]);
        }
    }
}