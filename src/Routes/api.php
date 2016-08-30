<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function () use ($app) {

    // Get the list of categories
    $this->get('/categories', function ($request, $response, $args){

        $response->withAddedHeader('Content-Type','application/json');
        $categories = $this->newsService->getCategories();
        $favorites = $this->storage->getFavoriteCategories();

        $result = [];
        foreach($categories as $category) {
            $result[] = ["name" => ucfirst($category), "favorite" => in_array($category, $favorites)];
        }

        $response->getBody()->write(json_encode($result));
    });

    // Get the articles
    $this->group('/articles', function ()  use ($app) {

        $this->get('/category', function ($request, $response, $args)  use ($app) {

            $homeCategory = $this->newsService->getHomePageCategory();

            $result = $this->newsService->getCategoryNews($homeCategory);
            $response->withAddedHeader('Content-Type','application/json');
            $response->getBody()->write(json_encode($result));
        });
        $this->get('/category/{category}', function ($request, $response, $args) {

            $result = [];
            if(!empty($args['category'])){
                $result = $this->newsService->getCategoryNews($args['category']);
            }

            $response->withAddedHeader('Content-Type','application/json');
            $response->getBody()->write(json_encode($result));
        })->setName('category-news-getter');
    });

    // Update the sources (List and switch between news sources)
    $this->get("/sources", function($request, $response, $args){
        $data = (new RSSReader\NewsSources\NewsAdapterFactory())->listSources();

        $response->withAddedHeader('Content-Type','application/json');
        $response->getBody()->write(json_encode(array("sources" => $data, "active" => $this->storage->getActiveNewsSource())));
    });
    $this->put("/sources", function($request, $response, $args){

        $response->withAddedHeader('Content-Type','application/json');
        $newsSource = $request->getParam('newsSource');

        $activeNewsSource = $this->storage->getActiveNewsSource();

        if($activeNewsSource == $newsSource) {
            $response->getBody()->write(json_encode(true));
            return;
        }

        $factory = new RSSReader\NewsSources\NewsAdapterFactory($activeNewsSource, $this->storage);
        if(!$newsSource OR !$factory->isValidSource($newsSource)) {
            $response->getBody()->write(json_encode(false));
        }

        $this->storage->setNewsSource($newsSource);
        $response->getBody()->write(json_encode(true));
    });

    // Manage the favorites
    $this->group('/favorites', function () {

        // Get the list of favorite categories
        $this->get('/categories', function ($request, $response, $args) {

            $response->withAddedHeader('Content-Type','application/json');
            $response->getBody()->write(json_encode(array_values($this->storage->getFavoriteCategories())));
        });
        // Update book with ID
        $this->post('/category', function ($request, $response, $args) {

            $response->withAddedHeader('Content-Type','application/json');
            $category = (string) $request->getParam("category");

            if(empty($category)) {
                $response->getBody()->write(json_encode(false));
            }else{

                $this->storage->addFavoriteCategory($category);
                $response->getBody()->write(json_encode(true));
            }
        });
        // Delete book with ID
        $this->delete('/category', function ($request, $response, $args) {

            $response->withAddedHeader('Content-Type','application/json');
            $category = (string) $request->getParam("category");

            if(empty($category)) {
                $response->getBody()->write(json_encode(false));
            }else{
                $this->storage->removeFavoriteCategory($category);
                $response->getBody()->write(json_encode(true));
            }
        });
    });

});