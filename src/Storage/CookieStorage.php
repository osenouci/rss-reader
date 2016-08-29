<?php
namespace RSSReader\Storage;

class CookieStorage implements \RSSReader\Storage\Interfaces\Storage {

    protected $cookie;
    protected $FAVORITE_KEY    = "cookieStorage_favorites";
    protected $NEWS_SOURCE_KEY = "cookieStorage_NEWS_SOURCE";

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
    public function getFavoriteCategories():array{

        $result = $this->read($this->FAVORITE_KEY);
        return !empty($result)?$result:[];
    }
    public function addFavoriteCategory(string $name) {

        $categories = $this->read($this->FAVORITE_KEY);

        if(empty($categories) OR !is_array($categories)){
            $categories = [];
        }
        $categories[] = $name;

        $this->write($this->FAVORITE_KEY, array_unique($categories));
    }
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
    public function clearFavoriteCategory() {
        $this->delete($this->FAVORITE_KEY);
    }
    public function getNewsSource():string{

        $source = $this->read($this->NEWS_SOURCE_KEY);
        return (!empty($source))?$source:"";
    }
    public function setNewsSource(string $value) {
        $this->write($this->NEWS_SOURCE_KEY, $value);
    }
}