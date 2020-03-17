<?php
namespace Fredylg\AzureApplicationInsights\Middleware;

use Closure;
use Fredylg\AzureApplicationInsights\ApplicationInsightsHelpers;

class ApplicationInsightsMiddleware
{

    /**
     * @var ApplicationInsightsMiddleware
     */
    private $applicationInsightHelpers;


    /**
     * @param ApplicationInsightsMiddleware $applicationInsightHelpers
     */
    public function __construct(ApplicationInsightsHelpers $applicationInsightHelpers)
    {
        $this->applicationInsightHelpers = $applicationInsightHelpers;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->applicationInsightHelpers->trackPageViewDuration($request);

        $response = $next($request);

        $this->applicationInsightHelpers->flashPageInfo($request);

        return $response;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    public function terminate($request, $response)
    {
        $this->applicationInsightHelpers->trackRequest($request, $response);
    }

}
