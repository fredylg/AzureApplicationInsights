# AzureApplicationInsights
a Laravel 6 package to implement Azure Application Insights

This pacakge is based on
https://github.com/Marchie/ms-application-insights-laravel


The request will send the following additional properties to Application Insights:

ajax (boolean): true if the request is an AJAX request
ip (string): The client's IP address
pjax (boolean): true if the request is a PJAX request
secure (boolean): true if the request was sent over HTTPS
route (string): The name of the route, if applicable
user (integer): The ID of the logged in user, if applicable
referer (string): The HTTP_REFERER value from the request, if available
