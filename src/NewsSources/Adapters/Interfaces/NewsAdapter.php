<?php
/**
 * Created by PhpStorm.
 * User: Othmane
 * Date: 8/29/2016
 * Time: 4:36 PM
 */
namespace RSSReader\NewsSources\Adapters\Interfaces;

use \RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter;

interface NewsAdapter {

    public function getCategories():array;
    public function getHomePageCategory(string $additionalCategory = ""):string;
    public function hasCategories():bool;
    public function setCategoryFormatter(CategoryFormatter $formatter);
    public function getCategoryNews(string $category):array;
}