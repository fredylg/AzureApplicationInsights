<?php

namespace Fredylg\AzureApplicationInsights\Facades;

use Fredylg\AzureApplicationInsights\ApplicationInsightsServer;
use Illuminate\Support\Facades\Facade;

class ApplicationInsightsServerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ApplicationInsightsServer';
      //  return ApplicationInsightsServer::class;
    }
}
