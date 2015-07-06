<?php

namespace Kevinsimard\CookielessSession\Providers;

use Illuminate\Session\SessionServiceProvider as OriginalServiceProvider;

class SessionServiceProvider extends OriginalServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSessionManager();

        $this->registerSessionDriver();

        $this->app->singleton('Kevinsimard\CookielessSession\Middleware\StartSession');
    }
}
