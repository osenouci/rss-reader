<?php
/**
 * ####################################################################################
 *  Reuters.com section
 * ####################################################################################
 */
define("URL_REUTERS_API", "http://www.reuters.com/tools/rss");
define("REUTERS_XML_FORMAT_PARAMETER", "?format=xml");

/**
 * ####################################################################################
 *  NewsAPI.com section
 * ####################################################################################
 */
define("URL_NEWSAPI_API", "https://newsapi.org/");

function debug($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}