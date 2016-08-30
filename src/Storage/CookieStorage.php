<?php
namespace RSSReader\Storage;

class CookieStorage implements \RSSReader\Storage\Interfaces\Storage {

    protected $cookie;
    protected $FAVORITE_KEY     = "cookieStorage_favorites";
    protected $NEWS_SOURCE_KEY  = "cookieStorage_NEWS_SOURCE";
    protected $NEWS_SOURCE_NAME = "cookieStorage_NEWS_SOURCE_NAME";

    public function setPrefix(string $prefix = "")
    {
        $this->FAVORITE_KEY = $prefix . $this->FAVORITE_KEY;
    }
    protected function write(string $key, $value){
        setcookie($key, json_encode($value), time() + (86400 * 7), "/");
    }
    protected function read(string $key) {
        return !empty($_COOKIE[$key])?json_decode($_COOKIE[$key], true):false;
    }
    protected function delete(string $key) {
        if(empty($this->read($key))){
            return;
        }
        $this->write($key, null);
    }
    /**
     * returns a list of favorite categories. (NOT USED)
     * @return array
     */
    public function getFavoriteCategories():array{

        $result = $this->read($this->FAVORITE_KEY);
        return !empty($result)?$result:[];
    }
    /**
     * Marks a category as the favorite. Only one can be marked at the time.
     * @param string $name
     */
    public function addFavoriteCategory(string $name) {

        $categories = $this->read($this->FAVORITE_KEY);

        if(empty($categories) OR !is_array($categories)){
            $categories = [];
        }
        $categories[] = $name;

        $this->write($this->FAVORITE_KEY, array_unique($categories));
    }
    /**
     * Un-marks a category from being the favorite one.
     * @param string $name
     */
    public function removeFavoriteCategory(string $name) {

        $categories = $this->read($this->FAVORITE_KEY);
        if(empty($categories)){
            return;
        }

        foreach($categories as $key => $category) {

            if(strtolower($name) == strtolower($category)) {
                unset($categories[$key]);
            }
        }

        $this->write($this->FAVORITE_KEY, $categories);
    }
    /**
     * Deletes the favorite categories' list.
     */
    public function clearFavoriteCategory() {
        $this->delete($this->FAVORITE_KEY);
    }
    /**
     * Gets the name of the news adapater being used.
     * @return string
     */
    public function getNewsSource():string{

        $source = $this->read($this->NEWS_SOURCE_KEY);
        return (!empty($source))?$source:"";
    }
    /**
     * Sets the name of the news adapater being used.
     * @return string
     */
    public function setNewsSource(string $value) {
        $this->write($this->NEWS_SOURCE_KEY, $value);
    }
    /**
     * Same as setNewsSource(). Clean up needed
     * @return string
     */
    public function setActiveNewsSource(string $value) {
        $this->write($this->NEWS_SOURCE_NAME, $value);
    }
    /**
     * Same as setNewsSource(). Clean up needed
     * @return string
     */
    public function getActiveNewsSource():string {
        $source = $this->read($this->NEWS_SOURCE_NAME);
        return !empty($source)?$source:"";
    }
}