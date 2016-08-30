<?php
/**
 * Created by PhpStorm.
 * User: Othmane
 * Date: 8/29/2016
 * Time: 4:36 PM
 */
namespace RSSReader\NewsSources\Adapters\Interfaces;

use \RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter;

/**
 * Interface NewsAdapter
 * @package RSSReader\NewsSources\Adapters\Interfaces
 */
interface NewsAdapter {

    /**
     * Returns the categories that the API supports as an array.
     * @return array
     */
    public function getCategories():array;
    /**
     * Returns the articles contained in the favorite page and if none has been marked such one, then it returns
     *  the articles of one of the predefined categories.
     * @return string
     */
    public function getHomePageCategory(string $additionalCategory = ""):string;
    /**
     * returns a boolean value used to indicate if the news API supports categories or not.
     * @return bool
     */
    public function hasCategories():bool;
    /**
     * Sets a formatter of the type: RSSReader\NewsSources\Formatters\Interfaces
     * The formatter is used to select a home category
     */
    public function setCategoryFormatter(CategoryFormatter $formatter);
    /**
     * Returns the articles contained in a given category.
     * @param $category
     * @return array
     */
    public function getCategoryNews(string $category):array;
}