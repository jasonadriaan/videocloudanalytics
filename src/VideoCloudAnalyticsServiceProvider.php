<?php

namespace Jasonadriaan\VideoCloudAnalytics;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Jasonadriaan\VideoCloudAnalytics\Commands\VideoCloudAnalyticsCommand;

class VideoCloudAnalyticsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('videocloudanalytics')
            ->hasConfigFile();
    }
}
