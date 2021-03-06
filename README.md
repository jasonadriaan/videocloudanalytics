# A Laravel Wrapper for Brightcove's VideoCloud Analytics API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jasonadriaan/videocloudanalytics.svg?style=flat-square)](https://packagist.org/packages/jasonadriaan/videocloudanalytics)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/jasonadriaan/videocloudanalytics/run-tests?label=tests)](https://github.com/jasonadriaan/videocloudanalytics/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/jasonadriaan/videocloudanalytics/Check%20&%20fix%20styling?label=code%20style)](https://github.com/jasonadriaan/videocloudanalytics/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jasonadriaan/videocloudanalytics.svg?style=flat-square)](https://packagist.org/packages/jasonadriaan/videocloudanalytics)

This package makes it simple for you to retrieve analytics from Brightcove VideoCloud's Analytics API without having to deal with authentication or repetitive api calls.

## Support: Buy me a coffee

I build and maintain this project in my free time. If it makes your life simpler you can [buy me a coffee](https://buymeacoffee.com/jasonadriaan).

## Installation

You can install the package via composer:

```bash
composer require jasonadriaan/videocloudanalytics
```

You will need to publish the config file with:

```bash
php artisan vendor:publish --tag="videocloudanalytics-config"
```

In your .env file please add the following lines with your API details from Brightcove VideoCloud

```php
VIDEOCLOUD_ACCOUNT_ID=xxxxx
VIDEOCLOUD_API_KEY=xxxxx
VIDEOCLOUD_API_SECRET=xxxxx
```

## Usage

I would recommend you go ahead and read the [VideoCloud Analytics API documentation](https://apis.support.brightcove.com/analytics/index.html) to understand
the underlying API.

Basic usage within your app would be as follows:

```php

use Jasonadriaan\VideoCloudAnalytics\VideoCloudAnalytics;

class main extends Controller
{
    
    public function index(){

        $videocloud = new VideoCloudAnalytics();
        $items = $videocloud->dimensions('date')
                            ->from('2021-08-04')
                            ->to('2022-01-31')
                            ->fields('date,daily_unique_viewers,video_view')
                            ->sort('date')
                            ->limit(30)
                            ->get();
        return $items;
    }

}

```
Notes:
- The get() method will return a Laravel Collection to make it easier for you to work with the data returned.
- The only required field would be the dimensions field. If you do not provide it the API call will fail. 
- For the full Dimension Guide please go read the [official documentation](https://apis.support.brightcove.com/analytics/dimension-guides/index.html).


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jason Adriaan](https://www.jasonadriaan.com)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
