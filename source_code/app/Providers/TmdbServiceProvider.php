<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tmdb\ApiToken;
use Tmdb\Client;

class TmdbServiceProvider extends ServiceProvider
{
    /**
     * Get the TMDB configuration from the config repository
     *
     * @return array
     */
    public function config()
    {
        return $this->app['config']->get('tmdb');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Configure any bindings that are version dependent
//        $this->app->bind('Tmdb\Laravel\Adapters\EventDispatcherAdapter', 'Tmdb\Laravel\Adapters\EventDispatcherLaravel5');

        // Let the IoC container be able to make a Symfony event dispatcher
//        $this->app->bind(
//            'Symfony\Component\EventDispatcher\EventDispatcherInterface',
//            'Symfony\Component\EventDispatcher\EventDispatcher'
//        );

        // Setup default configurations for the Tmdb Client
        $this->app->singleton('Tmdb\Client', function() {
            $config = $this->config();
            $options = $config['options'];
            // Use an Event Dispatcher that uses the Laravel event dispatcher
//            $options['event_dispatcher'] = $this->app->make('Tmdb\Laravel\Adapters\EventDispatcherAdapter');
            // Register the client using the key and options from config
            $token = new ApiToken($config['api_key']);
            return new Client($token, $options);
        });

        // bind the configuration (used by the image helper)
        $this->app->bind('Tmdb\Model\Configuration', function() {
            $configuration = $this->app->make('Tmdb\Repository\ConfigurationRepository');
            return $configuration->load();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('tmdb');
    }
}
