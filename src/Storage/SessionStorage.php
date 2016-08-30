<?php
namespace RSSReader\Storage;

class SessionStorage implements \RSSReader\Storage\Interfaces\Storage {

    protected $FAVORITE_KEY     = "sessionStorage_favorites";
    protected $NEWS_SOURCE_KEY  = "sessionStorage_NEWS_SOURCE";
    protected $NEWS_SOURCE_NAME = "sessionStorage_NEWS_SOURCE_NAME";

    public function __construct()
    {
        session_id(md5($_SERVER['REMOTE_ADDR']));
        session_start();
    }
    public function setPrefix(string $prefix = "")
    {
        $this->FAVORITE_KEY = $prefix . $this->FAVORITE_KEY;
    }
    protected function write(string $key, $value){
        $_SESSION[$key] = json_encode($value);
    }
    protected function read(string $key) {
        return !empty($_SESSION[$key])?json_decode($_SESSION[$key], true):false;
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
    public function setActiveNewsSource(string $value) {
        $this->write($this->NEWS_SOURCE_NAME, $value);
    }
    public function getActiveNewsSource():string {
        $source = $this->read($this->NEWS_SOURCE_NAME);
        return !empty($source)?$source:"";
    }
}