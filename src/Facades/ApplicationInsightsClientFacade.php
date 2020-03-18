<?php

namespace Fredylg\AzureApplicationInsights\Facades;

use Illuminate\Support\Facades\Facade;

class ApplicationInsightsClientFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ApplicationInsightsClient';
    }
}
