# Laravel Settings

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-settings
```

And then, if using Laravel 5, include the service provider within `app/config/app.php`.

``` php
'providers' => [
    // ... Illuminate Providers
    // ... App Providers
    DraperStudio\Settings\ServiceProvider::class
];
```

And, for convenience, add a facade alias to this same file at the bottom:

``` php
'aliases' => [
    // ... Illuminate Facades
    'Setting' => DraperStudio\Settings\Facades\Setting::class
];
```

## Configuration

Laravel Settings supports optional configuration.

To get started, you'll need to publish all configurations:

```bash
$ php artisan vendor:publish --provider="DraperStudio\Settings\ServiceProvider" --tag="config"
```

This will create a `config/settings.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

## Migration _(Only required if you use the database driver)_

To get started, you'll need to publish all migrations:

```bash
$ php artisan vendor:publish --provider="DraperStudio\Settings\ServiceProvider" --tag="migrations"
```

And then run the migrations to setup the database table.

```bash
$ php artisan migrate
```

## Usage

##### Get all settings
``` php
Setting::all();
```

##### Check if a setting exists
``` php
Setting::has($key);
```

##### Get a setting
``` php
Setting::get($key);
```

##### Set a setting
``` php
Setting::put($key, $value);
```

##### Delete a setting
``` php
Setting::forget($key);
```

##### Delete all settings
``` php
Setting::flush();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-settings.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Settings/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-settings.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-settings.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-settings.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-settings
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Settings
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-settings/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-settings
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-settings
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors

<!-- ## To-Do
- Drivers
    - Redis
    - Session **(maybe)**
- Multiple Configurations
- Entity-Related Configurations
- Fluent Interface
    - Setting::yaml()->get($key);
    - Setting::yaml()->put($key, $value);
    - Setting::yaml()->forget($key);
    - Setting::yaml()->flush(); -->
