<?php

namespace Ghidev\IntranetAuth;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class IntranetAuthServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param Repository $config
     */
    public function boot(Repository $config)
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'ghidev');

        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/ghidev')
        ]);

        $model = $config->get('auth.providers.users.model');

        Auth::provider('intranet-auth', function($app, array $config) use ($model) {
            return new IntranetUserAuthProvider($model);
        });
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}