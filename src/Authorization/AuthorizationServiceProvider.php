<?php

namespace Lucid\Authorization;

use Lucid\Authorization\Gateway\Kong\Auth;
use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {
            $auth = $this->app->make(config('security.authorization_service', 'lucid.authorization.kong.auth'));

            return $auth->handle($request);
        });
    }

    public function register()
    {
        $this->app->singleton('authorization', function ($app) {
            return new Authorization($app);
        });
        $this->app->singleton('lucid.authorization.kong.auth', function ($app) {
            return new Auth($app);
        });
    }
}