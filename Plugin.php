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
            'name' => 'riuson.rssreader::lang.plugin.name',
            'description' => 'riuson.rssreader::lang.plugin.description',
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
                'label' => 'riuson.rssreader::lang.backend.label',
                'url' => \Backend::url('riuson/rssreader/channels'),
                'description' => 'riuson.rssreader::lang.backend.description',
                'category' => \System\Classes\SettingsManager::CATEGORY_CMS,
                'icon' => 'icon-rss'
            ]
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('rssreader.update.channels', 'Riuson\RssReader\Commands\UpdateChannels');
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('rssreader:update/channels')->hourly();
    }
}
