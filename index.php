<?php
define("APP_DIR", dirname(__FILE__));
define("ROUTES" , APP_DIR . "/src/Routes");

require_once APP_DIR . "/vendor/autoload.php";
require_once APP_DIR . "/src/Config/define.php";

use Slim\Views\PhpRenderer;
use RSSReader\NewsSources\NewsAdapterFactory;

/**
 * ##########################################################################
 *  Create the DI container and configure it
 * ##########################################################################
 */
$container = new \Slim\Container(); // Create the DI container
$container['renderer'   ] = new PhpRenderer(APP_DIR . "/public");
$container['newsService'] = RSSReader\NewsSources\NewsAdapterFactory::getSource(NewsAdapterFactory::REUTERS);

/**
 * ##########################################################################
 *  Create the app and configure it
 *  NOTE: We follow the recommended way for the routes organize the routes:
 * http://www.slimframework.com/2011/09/24/how-to-organize-a-large-slim-framework-application.html
 * ##########################################################################
 */
$app = new \Slim\App($container);         // Init the slim framework and pass it the DI container

require_once ROUTES . "/middleware.php";  // load the middleware
require_once ROUTES . "/api.php";         // load the api routes
require_once ROUTES . "/static.php";      // load the routes that serve static pages (If any)
$app->run();                              // Run app