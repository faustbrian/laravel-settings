# Laravel Settings

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-settings
```

And then include the service provider within `app/config/app.php`.

``` php
BrianFaust\Settings\SettingsServiceProvider::class
```

And, for convenience, add a facade alias to this same file at the bottom:

``` php
'Setting' => BrianFaust\Settings\Facades\Setting
```

## Configuration

Laravel Settings supports optional configuration.

To get started, you'll need to publish all configurations:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Settings\SettingsServiceProvider" --tag="config"
```

This will create a `config/settings.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

## Migration _(Only required if you use the database driver)_

To get started, you'll need to publish all migrations:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Settings\ServiceProvider" --tag="migrations"
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

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)

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
