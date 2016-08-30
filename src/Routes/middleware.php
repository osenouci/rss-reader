<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Used to add CROSS to the application
 */
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
/**
 * Used to add CROSS to the application
 */
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', "*")
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, client-security-token')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

/**
 * When the API is used in away that it is not design, for example calling routes that don't exist, then we display
 * false and return 404 header.
 */
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