# Laravel Cookieless Session Middleware
[![Code Climate](https://codeclimate.com/github/kevinsimard/laravel-cookieless-session/badges/gpa.svg)](https://codeclimate.com/github/kevinsimard/laravel-cookieless-session)

All you need to do is to add the following key ```X-Session-Token``` to your requests' headers to load sessions.

## Installation
Replace the original start session middleware in ```app/Http/Kernel.php```

```php
<?php namespace App\Http;

use Illuminate\Foundation\Http;

class Kernel extends Http\Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        //'Illuminate\Session\Middleware\StartSession',
        'Kevinsimard\CookielessSession\Middleware\StartSession',
        ...
    ];
...
```
Replace the original session service provider in ```config/app.php```

```php
'providers' => [
    /*
     * Laravel Framework Service Providers...
     */
    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    'Illuminate\Bus\BusServiceProvider',
    'Illuminate\Cache\CacheServiceProvider',
    'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
    'Illuminate\Routing\ControllerServiceProvider',
    'Illuminate\Cookie\CookieServiceProvider',
    'Illuminate\Database\DatabaseServiceProvider',
    'Illuminate\Encryption\EncryptionServiceProvider',
    'Illuminate\Filesystem\FilesystemServiceProvider',
    'Illuminate\Foundation\Providers\FoundationServiceProvider',
    'Illuminate\Hashing\HashServiceProvider',
    'Illuminate\Mail\MailServiceProvider',
    'Illuminate\Pagination\PaginationServiceProvider',
    'Illuminate\Pipeline\PipelineServiceProvider',
    'Illuminate\Queue\QueueServiceProvider',
    'Illuminate\Redis\RedisServiceProvider',
    'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
    //'Illuminate\Session\SessionServiceProvider',
    'Illuminate\Translation\TranslationServiceProvider',
    'Illuminate\Validation\ValidationServiceProvider',
    'Illuminate\View\ViewServiceProvider',
    /*
     * Application Service Providers...
     */
    'Kevinsimard\CookielessSession\Providers\SessionServiceProvider',
    'App\Providers\AppServiceProvider',
    'App\Providers\BusServiceProvider',
    'App\Providers\ConfigServiceProvider',
    'App\Providers\EventServiceProvider',
    'App\Providers\RouteServiceProvider',
],
```

## Code Structure
    ┌── src/
    │   └── Kevinsimard/
    │       └── CookielessSession/
    │           └── Middleware/
    │               └── StartSession.php
                └── Providers/
    │               └── SessionServiceProvider.php
    ├── .gitattributes
    ├── .gitignore
    ├── composer.json
    └── README.md
