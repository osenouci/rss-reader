<?php
/**
 * Created by PhpStorm.
 * User: Othmane
 *
 * This adapter gets news from the website https://newsapi.org/ using their API.
 */
namespace RSSReader\NewsSources\Adapters;

use \RSSReader\NewsSources\Formatters\Interfaces\CategoryFormatter;
use \RSSReader\NewsSources\Adapters\Interfaces\NewsAdapter;

class NewsApiAdapter implements NewsAdapter {

    protected $formatter;
    protected $apiKey = "";

    /**
     * ReutersAdapter constructor.
     * @param string $url
     * @param string $xmlFormatParameter
     *
     * It sets the values for the following properties ReutersAdapter::URL and ReutersAdapter::xmlFormatParameter.
     * @note: Having those two values as parameters will help with testing the class since we can create a dummy
     * page locally and pass its URL to the class.
     */
    public function __construct(string $url)
    {
        $this->URL  = $url;
        $this->data = ["categories" => []];

        $this->apiKey = NEWSAPI_API_KEY;
        $this->readNewsData();

        if(empty($this->data)) {
            throw new Exception("Cannot reach reuters' API. Please check your connectivity!");
        }
    }
    /**
     * Sets a formatter of the type: RSSReader\NewsSources\Formatters\Interfaces
     * The formatter is used to select a home category
     */
    public function setCategoryFormatter(CategoryFormatter $formatter){
        $this->formatter = $formatter;
    }
    /**
     * Reads the categories from the API and stores them in the NewsApiAdapter::data property
     */
    protected function readNewsData(){

        $result = file_get_contents($this->URL . "v1/sources?language=en");
        $result = json_decode($result, true);

        if(empty($result["status"]) OR strtolower($result["status"]) != "ok"){
            return;
        }

        foreach($result["sources"] as $newsProvider) {

            $category = strtolower($newsProvider["category"]);
            if(!isset($this->data["categories"][$category])){
                $this->data["categories"][$category] = [];
            }

            $this->data["categories"][$category][] = $newsProvider["id"];
        }
    }
    /**
     * Returns a list of categories and their URL as an associative array.
     * @example
     * $rtNews = new NewsApiAdapter();
     * $result = $rtNews->getCategories();
     *
     * @return array
     */
    public function getCategories():array
    {
        return array_keys($this->data["categories"]);
    }
    /**
     * Returns the articles contained in the favorite page and if none has been marked such one, then it returns
     *  the articles of one of the predefined categories.
     * @return string
     */
    public function getHomePageCategory(string $additionalCategory = ""):string
    {
        $default = ["general", "technology", "sport"];
        if(!empty($additionalCategory)) {
            $default = array_merge([$additionalCategory], $default);
        }

        $this->formatter->setData($default);
        return $this->formatter->getHomeCategory($this->data["categories"]);
    }
    /**
     * Returns a boolean value that indicate if the adapter supports categories or not. If the keys are string then it
     * does. If the keys are integers than it does not.
     * @return bool
     */
    public function hasCategories():bool
    {
        if(empty($this->data)) {
            return false;
        }
        $categories = array_keys($this->data["categories"]);

        // Tests a random key and checks if it is a string or not.
        return is_string($categories[array_rand($categories)]);
    }
    /**
     * Returns the articles contained in a given category.
     * @param $category
     * @return array
     */
    public function getCategoryNews(string $category) :array {

        $sources = $articles = [];

        foreach($this->data["categories"] as $key => $value) {

            if(strtolower($key) == strtolower($category)) {
                $sources = $value;
                break;
            }
        }

        try{

            if(empty($sources)){
                throw new \Exception();
            }

            // For simplicity reasons we only take the first source.
            // If I had more time I would have maybe selected data from all the sources and removed duplicates.
            $articleList = [];

            /*
            foreach($sources as $source) {
                $news = file_get_contents($this->URL . "v1/articles?source={$source}&sortBy=top&apiKey=3e22f2fcc1344975ae2b2e69379e2a6e");
                $articleList[] = (json_decode($news, true))["articles"];
            }
             */

            $news = file_get_contents($this->URL . "v1/articles?source={$sources[0]}&apiKey=" . $this->apiKey);
            $news = (json_decode($news, true));

            if(empty($news["articles"])) {
                throw new \Exception();
            }

            // Parse the news items
            foreach($news["articles"] as $article){

                $articles[] = array(
                    "title" => !empty($article["title"])?$article["title"]:"",
                    "detail"=> !empty($article["description"])?$article["description"]:"",
                    "url"   => !empty($article["url"])?$article["url"]:"",
                    "img"   => [!empty($article["urlToImage"])?"<img src=\"{$article["urlToImage"]}\" />":""],
                    "date"  => !empty($article["publishedAt"])?$article["publishedAt"]:""
                );
            }

        }catch(\Exception $e){
            $articles = [];
        }

        return $articles;
    }
}