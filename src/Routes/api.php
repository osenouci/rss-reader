<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function ()  {

    // Get the list of categories
    $this->get('/categories', function ($request, $response, $args){

        $response->withAddedHeader('Content-Type','application/json');
        $response->getBody()->write(json_encode($this->newsService->getCategories()));
    });

    // Get the articles
    $this->group('/articles', function () {

        $this->get('/home-page', function ($request, $response, $args) {

        });
        $this->get('/category/{category}', function ($request, $response, $args) {

        });
    });

    // Update the sources (List and switch between news sources)
    $this->get("/sources", function($request, $response, $args){
        $data = RSSReader\NewsSources\NewsAdapterFactory::listSources();

        $response->withAddedHeader('Content-Type','application/json');
        $response->getBody()->write(json_encode($data));
    });
    $this->put("/sources", function($request, $response, $args){
        //$data = RSSReader\NewsSources\NewsAdapterFactory::getSource();
    });

    // Manage the favorites
    $this->group('/favorites', function () {

        // Get the list of favorite categories
        $this->get('/categories', function ($request, $response, $args) {

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