<?php
namespace Riuson\RssReader\Classes;

use Riuson\RssReader\Models\Item as ItemModel;
use Riuson\RssReader\Models\Channel as ChannelModel;
use DB;

class UpdateChannels
{

    /**
     *
     * @var Debug mode enabled
     */
    protected $mDebugMode;

    /**
     * Create a new instance
     */
    public function __construct()
    {
        // parent::__construct();
    }

    /**
     * Execute
     */
    public function updateAllChannels()
    {
        $channels = ChannelModel::all();

        if ($this->mDebugMode) {
            // var_dump($channels);
            echo get_class($channels);
            echo "\n";
        }

        foreach ($channels as $channel) {
            $this->updateOneChannel($channel);
        }
    }

    public function updateOneChannel($channel)
    {
        if ($this->mDebugMode) {
            printf("Update %s \n", $channel->url);
        }

        $serverResponse = $this->loadFeed($channel->url);

        if ($this->mDebugMode) {
            echo $serverResponse;
        }

        $domDoc = new \DOMDocument('1.0', 'UTF-8');
        $domDoc->loadXML($serverResponse);
        $domPath = new \DOMXPath($domDoc);

        $dateFormat = $channel->dateFormat;
        $nodeChannel = $domPath->query('//rss/channel')->item(0);
        $header = $this->parseValuesFromNode($domPath, $nodeChannel, $dateFormat);

        if ($this->mDebugMode) {
            //print_r($header);
        }

        $channel->title = $header->byName('title');
        $channel->description = $header->byName('description');
        $channel->language = $header->byName('language');
        $channel->pubDate = $header->byName('pubDate');
        $channel->lastBuildDate = $header->byName('lastBuildDate');
        $channel->save();

        $nodesItems = $domPath->query("item", $nodeChannel);

        foreach ($nodesItems as $nodeItem) {
            $itemData = $this->parseValuesFromNode($domPath, $nodeItem, $dateFormat);

            $item = ItemModel::where('guid', '=', $itemData->byName('guid'))->first();

            if ($item == null) {
                $item = new ItemModel();
                $item->channel = $channel;
                $item->title = $itemData->byName('title');
                $item->link = $itemData->byName('link');
                $item->description = $itemData->byName('description');
                $item->pubDate = $itemData->byName('pubDate');
                $item->guid = $itemData->byName('guid');
                $item->save();
            }

            if ($this->mDebugMode) {
                print_r($item);
            }
        }
    }

    public function setDebug($value)
    {
        $this->mDebugMode = $value;
    }

    private function loadFeed($url)
    {
        $serverResponse = '';

        // send request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $serverResponse = curl_exec($curl);
        curl_close($curl);

        return $serverResponse;
    }

    private function parseValuesFromNode($domPath, $node, $dateFormat)
    {
        $result = new DataValues($domPath, $node, $dateFormat);
        return $result;
    }
}