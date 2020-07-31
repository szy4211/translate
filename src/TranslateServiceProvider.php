<?php

namespace Szy4211\Translate;


class TranslateServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__ . '/../config/translate.php' => config_path('translate.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Translate::class, function ($app) {
            return new Translate($app['config']['translate']);
        });
        $this->app->alias(Translate::class, 'translate');
    }

    public function provides()
    {
        return [Translate::class, 'translate'];
    }
}