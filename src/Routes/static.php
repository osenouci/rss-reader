<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/*

No static pages are served any more. The project has been divided into two parts:
1- The API
2- Stand alone interface that uses CROS requests.

// Define app routes
$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, "./index.html", $args);
});
*/