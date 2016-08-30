<?php
namespace RSSReader\Storage\Interfaces;

/**
 * Interface used to describe the different methods that shoould be supported by storage systems.
 * Interface Storage
 * @package RSSReader\Storage\Interfaces
 */
interface Storage {

    /**
     * returns a list of favorite categories. (NOT USED)
     * @return array
     */
    public function getFavoriteCategories():array;
    /**
     * Marks a category as the favorite. Only one can be marked at the time.
     * @param string $name
     */
    public function addFavoriteCategory(string $name);
    /**
     * Un-marks a category from being the favorite one.
     * @param string $name
     */
    public function removeFavoriteCategory(string $name);
    /**
     * Deletes the favorite categories' list.
     */
    public function clearFavoriteCategory();
    /**
     * Gets the name of the news adapater being used.
     * @return string
     */
    public function getNewsSource():string;
    /**
     * Sets the name of the news adapter being used.
     * @return string
     */
    public function setNewsSource(string $value);
    /**
     * Same as setNewsSource(). Clean up needed
     * @return string
     */
    public function setActiveNewsSource(string $value);
    /**
     * Same as getNewsSource(). Clean up needed
     * @return string
     */
    public function getActiveNewsSource():string;
}