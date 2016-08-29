<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Define app routes
$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, "./index.html", $args);
});
