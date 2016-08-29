<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function ()  {

    // Get the list of categories
    $this->get('/categories', function ($request, $response, $args){

        debug($this->newsService->getCategories());

        exit();

        return $this->renderer->render($response, "./index.html", $args);
    });

    // Get the articles
    $this->group('/articles', function () {


        $this->get('/home-page', function ($request, $response, $args) {

        });
        $this->get('/category/{category}', function ($request, $response, $args) {

        });

    });

    // Manage the favorites
    $this->group('/favorites', function () {

        // Get the list of favorite categories
        $this->get('/category', function ($request, $response, $args) {

        });
        // Update book with ID
        $this->post('/category/{category}', function ($request, $response, $args) {
            $category = $request->getAttribute("category");
        });
        // Delete book with ID
        $this->delete('/category/{category}', function ($request, $response, $args) {
            $category = $request->getAttribute("category");
        });
    });

});