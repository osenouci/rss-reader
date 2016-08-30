<?php
namespace RSSReader\NewsSources\Formatters\Interfaces;

/**
 * Interface CategoryFormatter
 *
 * This interface is used to describe a set of classes that uses different algorithms to set select the home page
 * category. API supply different categories but not a home one. So this interface describes a set of algorithms
 * that are injected into new adapters to help them select home news.
 *
 * BasicCategoryFormatter is an example of a simple implementation.
 *
 * @package RSSReader\NewsSources\Formatters\Interfaces
 */
interface CategoryFormatter {

    /**
     * This function can be used to pass any kind of data to the algorithm to be used later on by
     * CategoryFormatter::getHomeCategory method.
     * @param array $data
     * @return mixed
     */
    public function setData    (array $data);
    /**
     * Applies an algorithm and return a category that can be considered as home category.
     * @param array $categories
     * @return string
     */
    public function getHomeCategory(array $categories):string;
}