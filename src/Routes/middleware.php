<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, $next)
{
    $response = $next($request, $response);

    // Check if the response should render a 404
    if (200 != $response->getStatusCode()) { // A 404 should be invoked

        $response->withAddedHeader('Content-Type', 'application/json');
        header('HTTP/1.0 404 Not Found', true, 404);
        echo 'false';
        exit();
    }

    return $response;
});