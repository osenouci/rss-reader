<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function () use ($app) {

    /***
     * Returns the list of categories of a given news adapter.
     */
    $this->get('/categories', function ($request, $response, $args){

        $response->withAddedHeader('Content-Type','application/json');
        $categories = $this->newsService->getCategories();
        $favorites = $this->storage->getFavoriteCategories();

        $result = [];
        foreach($categories as $category) {
            $result[] = ["name" => ucfirst($category), "favorite" => in_array(strtolower($category), $favorites)];
        }

        $response->getBody()->write(json_encode($result));
    });

    // Get the articles
    $this->group('/articles', function ()  use ($app) {

        /***
         * Gets the articles of the favorite page if available, if not available then it returns a category defined by
         * formatter. see RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter
         */
        $this->get('/category', function ($request, $response, $args)  use ($app) {

            $additionalCategory = $this->storage->getFavoriteCategories();
            $additionalCategory = !empty($additionalCategory[0])?$additionalCategory[0]:"";

            $homeCategory = $this->newsService->getHomePageCategory($additionalCategory);

            $result = $this->newsService->getCategoryNews($homeCategory);
            $response->withAddedHeader('Content-Type','application/json');
            $response->getBody()->write(json_encode($result));
        });
        /***
         * Gets the articles of a given category defined by {category}
         */
        $this->get('/category/{category}', function ($request, $response, $args) {

            $result = [];
            if(!empty($args['category'])){
                $result = $this->newsService->getCategoryNews($args['category']);
            }

            $response->withAddedHeader('Content-Type','application/json');
            $response->getBody()->write(json_encode($result));
        })->setName('category-news-getter');
    });
    /**
     * Gets the list of news adapters and the active one.
     */
    $this->get("/sources", function($request, $response, $args){
        $data = (new RSSReader\NewsSources\NewsAdapterFactory())->listSources();

        $response->withAddedHeader('Content-Type','application/json');
        $response->getBody()->write(json_encode(array("sources" => $data, "active" => $this->storage->getActiveNewsSource())));
    });
    /**
     * Used to switch between news adapters
     */
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
        /**
         * Get the list of favorite categories (NOT USED!)
         */
        $this->get('/categories', function ($request, $response, $args) {

            $response->withAddedHeader('Content-Type','application/json');
            $response->getBody()->write(json_encode(array_values($this->storage->getFavoriteCategories())));
        });
        /**
         * Used to select a category as the favorite one.
         */
        $this->post('/category', function ($request, $response, $args) {

            $response->withAddedHeader('Content-Type','application/json');
            $category = (string) $request->getParam("category");

            if(empty($category)) {
                $response->getBody()->write(json_encode(false));
            }else{

                $this->storage->addFavoriteCategory(strtolower($category));
                $response->getBody()->write(json_encode(true));
            }
        });
        /**
         * Used to un-mark a category as the favorite one.
         */
        $this->delete('/category/{category}', function ($request, $response, $args) {

            $response->withAddedHeader('Content-Type','application/json');
            $category = (string) !empty($args["category"])?$args["category"]:"";

            if(empty($category)) {
                $response->getBody()->write(json_encode(false));
            }else{

                $this->storage->removeFavoriteCategory(strtolower($category));
                $response->getBody()->write(json_encode(true));
            }
        });
    });

});