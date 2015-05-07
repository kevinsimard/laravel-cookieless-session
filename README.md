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

## Code Structure
    ┌── src/
    │   └── Kevinsimard/
    │       └── CookielessSession/
    │           └── Middleware/
    │               └── StartSession.php
    ├── .gitattributes
    ├── .gitignore
    ├── composer.json
    └── README.md
