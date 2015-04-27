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

    public function registerComponents()
    {
        return [
            'Riuson\RssReader\Components\RssChannel' => 'rssChannel'
        ];
    }

    public function registerSettings()
    {
        return [
            'rssreader' => [
                'label' => 'Rss Reader',
                'url' => \Backend::url('riuson/rssreader/channels'),
                'description' => 'RSS Channels',
                'category' => \System\Classes\SettingsManager::CATEGORY_CMS,
                'icon' => 'icon-rss'
            ]
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('rssreader.update.channels', 'Riuson\RssReader\Commands\UpdateChannels');
    }
}
