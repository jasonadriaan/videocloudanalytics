<?php

namespace Jasonadriaan\VideoCloudAnalytics\Commands;

use Illuminate\Console\Command;

class VideoCloudAnalyticsCommand extends Command
{
    public $signature = 'videocloudanalytics';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
