<?php
namespace RSSReader\NewsSources\Formatters;

use \RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter;

/**
 * This is Formatter is considered some how dumb as it selects the first category it sees as the home one.
 * Class BasicCategoryFormatter
 * @package RSSReader\NewsSources\Formatters
 */
class BasicCategoryFormatter implements CategoryFormatter {

    protected $homeCategories = [];

    /**
     * This function can be used to pass any kind of data to the algorithm to be used later on by
     * CategoryFormatter::getHomeCategory method.
     * @param array $data
     * @return mixed
     */
    public function setData    (array $data) {
        $this->homeCategories = $data;  // The categories that we would like to see on the home page.
    }
    /**
     * Applies an algorithm and return a category that can be considered as home category.
     * @param array $categories
     * @return string
     */
    public function getHomeCategory(array $categories):string
    {
        if(empty($categories)) {    // Data check
            return array();
        }

        foreach($this->homeCategories as $category) { // Go through the categories and return the first one available

            if(isset($categories[$category])) {
                return $category;
            }
        }

        // Our prioritized categories are not found then select a random category.
        return array_rand($categories);
    }
}