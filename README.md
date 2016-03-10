# Laravel Cookieless Session Middleware

All you need to do is to add the following key `X-Session-Token` to your requests' headers to load sessions.

## Installation

Replace the original start session middleware in `app/Http/Kernel.php`.

```php
<?php namespace App\Http;

use Illuminate\Foundation\Http;

class Kernel extends Http\Kernel
{
    /**
     * @var array
     */
    protected $middleware = [
        //'Illuminate\Session\Middleware\StartSession',
        'Kevinsimard\CookielessSession\Middleware\StartSession',
        ...
    ];
...
```

Replace the original session service provider in `config/app.php`.

```php
'providers' => [
    ...
    //'Illuminate\Session\SessionServiceProvider',
    'Kevinsimard\CookielessSession\Providers\SessionServiceProvider',
    ...
],
```

## Code Structure

    ├── src
    │   └── Kevinsimard
    │       └── CookielessSession
    │           ├── Middleware
    │           │   └── StartSession.php
    │           └── Providers
    │               └── SessionServiceProvider.php
    ├── .editorconfig
    ├── .gitattributes
    ├── .gitignore
    ├── LICENSE.txt
    ├── README.md
    └── composer.json

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
