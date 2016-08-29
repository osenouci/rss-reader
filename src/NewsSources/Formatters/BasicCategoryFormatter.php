<?php
namespace RSSReader\NewsSources\Formatters;

use \RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter;

class BasicCategoryFormatter implements CategoryFormatter {

    protected $homeCategories = [];
    public function setData    (array $data) {
        $this->homeCategories = $data;  // The categories that we would like to see on the home page.
    }
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
    public function formatCategory ():array
    {
        return array();
    }
}