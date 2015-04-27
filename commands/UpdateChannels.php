<?php
namespace Riuson\RssReader\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateChannels extends Command
{

    /**
     *
     * @var string The console command name
     */
    protected $name = "rssreader:update/channels";

    /**
     *
     * @var string The console command description
     */
    protected $description = "Update all channels.";

    /**
     * Create a new command instance
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command
     */
    public function fire()
    {
        $debug = $this->option('debug');

        $this->output->writeln(get_class($this));

        try {
            $updater = new \Riuson\RssReader\Classes\UpdateChannels();

            if ($debug) {
                $updater->setDebug(true);
            }

            $updater->updateAllChannels();
        } catch (Exception $e) {
            if ($debug) {
                $this->output->writeln($e->getMessage());
            }
        }
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        // name, shortcut, mode, description, defaultValue
        return [
            [
                'debug',
                null,
                InputOption::VALUE_NONE,
                'Show debug output.',
                null
            ]
        ];
    }
}