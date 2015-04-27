<?php
namespace Riuson\RssReader;

use System\Classes\PluginBase;

/**
 * RssReader Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'RssReader',
            'description' => 'Get and read RSS from other sites.',
            'author' => 'Riuson',
            'icon' => 'icon-rss'
        ];
    }
}
