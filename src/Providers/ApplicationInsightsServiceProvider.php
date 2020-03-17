<?php

namespace Fredylg\AzureApplicationInsights\Providers;

//use Illuminate\Support\ServiceProvider;

use Illuminate\Support\ServiceProvider as ServiceProvider;

use Fredylg\AzureApplicationInsights\Middleware\ApplicationInsightsMiddleware;
use Fredylg\AzureApplicationInsights\ApplicationInsightsClient;
use Fredylg\AzureApplicationInsights\ApplicationInsightsHelpers;
use Fredylg\AzureApplicationInsights\ApplicationInsightsServer;
use ApplicationInsights\Telemetry_Client;

class ApplicationInsightsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->singleton('ApplicationInsightsServer', function ($app) {
            $telemetryClient = new Telemetry_Client();
            return new ApplicationInsightsServer($telemetryClient);
        });

        $this->app->singleton('ApplicationInsightsMiddleware', function ($app) {
            $ApplicationInsightsHelpers = new ApplicationInsightsHelpers($app['ApplicationInsightsServer']);
            return new ApplicationInsightsMiddleware($ApplicationInsightsHelpers);
        });

        $this->app->singleton('ApplicationInsightsClient', function ($app) {
            return new ApplicationInsightsClient();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->handleConfigs();
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../../config/ApplicationInsightsConfig.php';

        $this->publishes([$configPath => config_path('ApplicationInsightsConfig.php')]);

        $this->mergeConfigFrom($configPath, 'ApplicationInsightsConfig');

    }
}
