# Laravel Settings

Based on [laravel-settings](https://github.com/anlutro/laravel-settings) by [anlutro](https://github.com/anlutro).

## New Features

- JsonStore **(Updated)**
- XmlStore
- YamlStore
- YamlInlineStore

## Installation

First, pull in the package through Composer.

```js
composer require draperstudio/laravel-settings:1.0.*@dev
```

And then, if using Laravel 5, include the service provider within `app/config/app.php`.

```php
'providers' => [
    // ... Illuminate Providers
    // ... App Providers
    DraperStudio\Settings\ServiceProvider::class
];
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
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
```php
Setting::all();
```

##### Check if a setting exists
```php
Setting::has($key);
```

##### Get a setting
```php
Setting::get($key);
```

##### Set a setting
```php
Setting::put($key, $value);
```

##### Delete a setting
```php
Setting::forget($key);
```

##### Delete all settings
```php
Setting::flush();
```

## To-Do
- Drivers
    - Redis
    - Session **(maybe)**
- Multiple Configurations
- Entity-Related Configurations
- Fluent Interface
    - Setting::yaml()->get($key);
    - Setting::yaml()->put($key, $value);
    - Setting::yaml()->forget($key);
    - Setting::yaml()->flush();

## License

Laravel Settings is licensed under [The MIT License (MIT)](LICENSE).
