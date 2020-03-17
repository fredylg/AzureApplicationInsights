<?php
namespace Fredylg\AzureApplicationInsights\Handlers;

use Exception;
use Fredylg\AzureApplicationInsights\ApplicationInsightsHelpers;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class ApplicationInsightsExceptionHandler extends ExceptionHandler
{

    /**
     * @var ApplicationInsightsHelpers
     */
    private $ApplicationInsightsHelpers;


    public function __construct(ApplicationInsightsHelpers $ApplicationInsightsHelpers, LoggerInterface $log)
    {
        $this->ApplicationInsightsHelpers = $ApplicationInsightsHelpers;
        parent::__construct($log);
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        foreach ($this->dontReport as $type)
        {
            if ($e instanceof $type)
            {
                return parent::report($e);
            }
        }

        $this->ApplicationInsightsHelpers->trackException($e);

        return parent::report($e);
    }
}
