<?php

namespace Jasonadriaan\VideoCloudAnalytics\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jasonadriaan\VideoCloudAnalytics\VideoCloudAnalytics
 */
class VideoCloudAnalytics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'videocloudanalytics';
    }
}
