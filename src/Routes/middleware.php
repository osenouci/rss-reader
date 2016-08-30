<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', "*")
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, client-security-token')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

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