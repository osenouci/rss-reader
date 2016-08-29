<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Define app routes
$app->get('/categories', function ($request, $response, $args) {

    debug($this->newsService->getCategories());

    exit();

    return $this->renderer->render($response, "./index.html", $args);
});
