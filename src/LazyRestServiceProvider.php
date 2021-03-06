<?php


namespace robertogallea\LaravelLazyRest;

use Illuminate\Support\ServiceProvider;

class LazyRestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lazy_rest.php', 'lazy_rest');

        $this->app->singleton('lazyrest', function($app) {
            return new LaravelLazyRest();
        });
    }


    /**
     * Boots the service provider
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function bootForConsole()
    {
        $this->publishes([
            __DIR__ . '/../config/lazy_rest.php' => config_path('lazy_rest.php')
        ], 'config');
    }
}